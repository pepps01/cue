<?php

namespace App\Http\Controllers\CueVendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVendorRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VendorController extends Controller
{
    use ApiResponse;

    public function updateVendor(UpdateVendorRequest $request)
    {
        $data = $request->validated();
        if (isset($data['business_email'])) {
            $data['email'] = $data['business_email'];
        }
        if (isset($data['business_phone'])) {
            $data['phone'] = $data['business_phone'];
        }
        if (isset($data['business_location'])) {
            $data['address'] = $data['business_location'];
        }
        if (isset($data['opening_days'])) {
            $data['opening_days'] = json_encode($data['opening_days']);
        }
        $user = User::find(auth()->user()->id);
        $vendor = $user->profile;
        $user->update($data);
        $vendor->update($data);
        return ApiResponse::successResponseWithData(new UserResource($user), "Updated was Successfull", Response::HTTP_OK);
    }

    public function setStatus($status)
    {
        $vendor = auth()->user()->profile;
        $vendor->update([
            'is_opened' => $status == 'true' ? 1 : 0
        ]);
        return ApiResponse::successResponse("Status set successfully", Response::HTTP_OK);
    }
}
