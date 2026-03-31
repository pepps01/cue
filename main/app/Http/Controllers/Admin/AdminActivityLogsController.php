<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminLogResource;
use App\Models\Admin;
use App\Models\AdminActivityLog;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminActivityLogsController extends Controller
{
    use ApiResponse;

    public function getAllLogs()
    {
        $adminLogs = AdminActivityLog::orderBy('created_at', 'DESC')->get();
        $adminLogResource = AdminLogResource::collection($adminLogs);
        return ApiResponse::successResponseWithData($adminLogResource, "All Admin Activity Logs Retrieved", Response::HTTP_OK);
    }

    public function getSingleLog(AdminActivityLog $log)
    {
        $adminLogResource = new AdminLogResource($log);
        return ApiResponse::successResponseWithData($adminLogResource, "Activity Log Details retrieved", Response::HTTP_OK);
    }

    public function getLogsByAdmin(Admin $admin)
    {
        $adminLogs = AdminActivityLog::where('admin_user_id', $admin->user_id)->orderBy('created_at', 'DESC')->get();
        $adminLogResource = AdminLogResource::collection($adminLogs);
        return ApiResponse::successResponseWithData($adminLogResource, "Activty Logs by Admin retrieved", Response::HTTP_OK);
    }
}
