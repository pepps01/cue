<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SosReportResource;
use App\Http\Resources\SosResource;
use App\Models\SosRecord;
use App\Models\SosReports;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminSOSController extends Controller
{
    use ApiResponse;

    public function getAllSOS()
    {
        $sos = SosRecord::orderBy('created_at', 'DESC')->get();
        return ApiResponse::successResponseWithData(SosResource::collection($sos), "Records retrieved", Response::HTTP_OK);
    }

    public function getSingleSOS(SosRecord $sos)
    {
        return ApiResponse::successResponseWithData(new SosResource($sos), "Single SOS Record retrieved", Response::HTTP_OK);
    }

    public function getAllSOSReports()
    {
        $reports = SosReports::orderBy('created_at', 'DESC')->get();
        return ApiResponse::successResponseWithData(SosReportResource::collection($reports), "All reports Retrieved", Response::HTTP_OK);
    }

    public function getSinlgeSOSReport(SosReports $report)
    {
        return ApiResponse::successResponseWithData(new SosReportResource($report), "Single report retrieved", Response::HTTP_OK);
    }

    public function getReportsBySOSID($sosID)
    {
        $sos = SosRecord::findOrFail($sosID);
        $reports = SosReports::where('sos_id', $sos->id)->orderBy('created_at', 'DESC')->get();
        return ApiResponse::successResponseWithData(SosReportResource::collection($reports), "All reports Retrieved", Response::HTTP_OK);
    }

    public function removeSOS(SosRecord $sos)
    {
        if ($sos->status != "Resolved") {
            return ApiResponse::errorResponse("Only resolved SOS records can be deleted", Response::HTTP_BAD_REQUEST);
        }
        $reports = $sos->reports;
        if ($reports) {
            $reports->each(function ($report) {
                $report->delete();
            });
        }
        $sos->delete();
        return ApiResponse::successResponse("Record was removed", Response::HTTP_OK);
    }
    public function removeReport(SosReports $report)
    {
        $report->delete();
        return ApiResponse::successResponse("Report was removed", Response::HTTP_OK);
    }
}
