<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\VerificationCode;
use App\Traits\VerificationTraits;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class PasswordController extends Controller
{
    use VerificationTraits;

    //send password reset code
    public function sendResetPasswordCode(Request $request, string $application_name)
    {
        $data = $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where('email', $data['email'])->where('application_name', $application_name)->first();

        if (!$user) {
            return ApiResponse::errorResponse('Invalid Credentials!', Response::HTTP_NOT_FOUND);
        }

        //send password reset mail
        $this->sendVerificationCode($data['email'], 'password', $user['firstname']);
        return ApiResponse::successResponse('Password Reset Code has been sent', Response::HTTP_OK);
    }


    public function resetPassword(ResetPasswordRequest $request, string $application_name)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->where('application_name', $application_name)->first();
        $code = VerificationCode::where('verifiable', $data['email'])->first();

        if (!$user) {
            return ApiResponse::errorResponse('Invalid Credentials!', Response::HTTP_NOT_FOUND);
        }

        $user->update([
            'password' => Hash::make($data['password'])
        ]);
        $code->delete();
        return ApiResponse::successResponse('Password reset was successful', Response::HTTP_OK);
    }
}
