<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceptSOSRequest;
use App\Http\Requests\InitiateSOSRequest;
use App\Http\Requests\SendSOSReportRequest;
use App\Http\Resources\SosReportResource;
use App\Http\Resources\SosResource;
use App\Models\Driver;
use App\Models\Rider;
use App\Models\SosReaction;
use App\Models\SosRecord;
use App\Models\SosReports;
use App\Models\Trip;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneralSOSController extends Controller
{
    use ApiResponse;

    public function initiate(Trip $trip, InitiateSOSRequest $request)
    {
        if ($trip->status != "Ongoing") {
            return ApiResponse::errorResponse("Initiate SOS only for ongoing trips", Response::HTTP_BAD_REQUEST);
        }
        $data = $request->validated();
        $data['trip_id'] = $trip->id;
        $data['rider_id'] = $trip->rider_id;
        $data['initiated_by'] = auth()->user()->id;
        $data['driver_id'] = $trip->driver_id;

        $sos = SosRecord::create($data);
        return ApiResponse::successResponseWithData(new SosResource($sos), "Your SOS emergency alert has been sent intiated", Response::HTTP_CREATED);
    }

    public function acceptSOS(SosRecord $sos, AcceptSOSRequest $request)
    {
        $data = $request->validated();
        $trip = Trip::find($sos->trip_id);

        if ($sos->initiated_by == $trip->rider->user_id) {
            $not_allowed = Driver::find($trip->driver_id);
        } elseif ($sos->initiated_by == $trip->driver->user_id) {
            $not_allowed = Rider::find($trip->rider_id);
        }
        if ($not_allowed->user_id == auth()->user()->id || $sos->initiated_by == auth()->user()->id) {
            return ApiResponse::errorResponse("This SOS Request cannot be reacted to by this User", Response::HTTP_BAD_REQUEST);
        }
        if ($sos->status == "Resolved") {
            return ApiResponse::errorResponse("The SOS has been resolved already", Response::HTTP_BAD_REQUEST);
        }
        $getPrevReactions = SosReaction::where('sos_id', $sos->id)->get();
        if (count($getPrevReactions) == 5) {
            return ApiResponse::errorResponse("SOS Reaction has reached it's Maximum. Thanks for considering", Response::HTTP_CONFLICT);
        }

        SosReaction::create([
            'sos_id' => $sos->id,
            'distressed_user' => $sos->initiated_by,
            'accepted_by' => auth()->user()->id,
            'accepted_at' => Carbon::now(),
            'accept_location' => $data['accept_location']
        ]);

        $sos->update(['status' => "Accepted"]);
        $result = ['sosID' => $sos->id, 'tripID' => $sos->trip_id];
        return ApiResponse::successResponseWithData($result, "SOS Emegency accepted", Response::HTTP_ACCEPTED);
    }

    public function reportSOS(SosRecord $sos, SendSOSReportRequest $request)
    {
        $data = $request->validated();
        $trip = Trip::find($sos->trip_id);

        if ($sos->initiated_by == $trip->rider->user_id) {
            $not_allowed = Driver::find($trip->driver_id);
        } elseif ($sos->initiated_by == $trip->driver->user_id) {
            $not_allowed = Rider::find($trip->rider_id);
        }
        if ($not_allowed->user_id == auth()->user()->id) {
            return ApiResponse::errorResponse("This action cannot be processed by this user", Response::HTTP_BAD_REQUEST);
        }

        if ($sos->status != "Accepted") {
            return ApiResponse::errorResponse("The SOS emergency has not been accepted yet", Response::HTTP_BAD_REQUEST);
        }

        $data['sos_id'] = $sos->id;
        $data['user_id'] = auth()->user()->id;
        $sos_report = SosReports::create($data);
        return ApiResponse::successResponseWithData(new SosReportResource($sos_report), "Report sent successfully", Response::HTTP_CREATED);
    }

    public function sosDetails(SosRecord $sos)
    {
        return ApiResponse::successResponseWithData(new SosResource($sos), "Order details retrievd", Response::HTTP_CREATED);
    }

    public function resolve(SosRecord $sos)
    {
        if ($sos->status == "Resolved") {
            return ApiResponse::errorResponse("The SOS Emergency has already been resolved", Response::HTTP_BAD_REQUEST);
        }
        if ($sos->status != "Accepted") {
            return ApiResponse::errorResponse("The SOS Emergency has not been accepted yet", Response::HTTP_BAD_REQUEST);
        }
        if ($sos->initiated_by != auth()->user()->id) {
            return ApiResponse::errorResponse("You cannot resolve an SOS that wasn't created by you", Response::HTTP_BAD_REQUEST);
        }
        $sos->update([
            'status' => "Resolved"
        ]);
        return ApiResponse::successResponse("The SOS emergency has been resolved", Response::HTTP_OK);
    }
}
