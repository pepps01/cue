<?php

namespace App\Http\Controllers\Cue;

use App\Http\Controllers\Controller;
use App\Http\Requests\InitiateSOSRequest;
use App\Http\Resources\SosResource;
use App\Models\SosRecord;
use App\Models\Trip;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RiderSOSController extends Controller
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
        $data['driver_id'] = $trip->driver_id;

        $sos = SosRecord::create($data);
        return ApiResponse::successResponseWithData(new SosResource($sos), "Your SOS emergency alert has been sent intiated", Response::HTTP_CREATED);
    }
}
