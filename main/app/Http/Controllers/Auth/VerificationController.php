<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyCodeRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\VerificationCode;
use App\Traits\VerificationTraits;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{
    use VerificationTraits;

    //verify email
    public function verifyEmail(VerifyCodeRequest $request, string $application_name)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->where('application_name', $application_name)->first();
        $verifyCode = $this->verifyCode($data['code'], $data['email']);
        $code = VerificationCode::where('verifiable', $data['email'])->first();

        if (!$user) {
            return ApiResponse::errorResponse('Invalid Credentials!', Response::HTTP_NOT_FOUND);
        }
        if (!$verifyCode) {
            return ApiResponse::errorResponse('Invalid code!', Response::HTTP_UNAUTHORIZED);
        }
        if ($code->expires_at < now()) {
            return ApiResponse::errorResponse('Verification code expired!', Response::HTTP_UNAUTHORIZED);
        }
        $user->update([
            'email_verified_at' => now(),
        ]);

        $code->delete();

        $userData = new UserResource($user);
        $accessToken = $user->createToken('Auth Token')->accessToken;
        return ApiResponse::successResponseWithData($userData, 'Verification successful', Response::HTTP_OK, $accessToken);
    }

    //resend verify code
    public function resendVerifyCode(Request $request, string $application_name)
    {
        $data = $request->validate(['email' => 'required|email|exists:users,email']);
        $user = User::where('email', $data['email'])->where('application_name', $application_name)->first();

        if (!$user) {
            return ApiResponse::errorResponse('Invalid Credentials!', Response::HTTP_NOT_FOUND);
        }

        if ($user->hasVerifiedEmail()) {
            return ApiResponse::successResponse('Email verified already', Response::HTTP_ALREADY_REPORTED);
        }

        $this->sendVerificationCode($request->email, 'verification', $user['firstname']);
        return ApiResponse::successResponse('Verification code Re-sent', Response::HTTP_OK);
    }

    //verify an otp code
    public function verifyPasswordOtp(VerifyOtpRequest $request)
    {
        $data = $request->validated();
        $verifyCode = $this->verifyCode($data['code'], $data['email']);
        $code = VerificationCode::where('verifiable', $data['email'])->first();

        if (!$verifyCode) {
            return ApiResponse::errorResponse('Invalid code!', Response::HTTP_NOT_FOUND);
        }
        if ($code->expires_at < now()) {
            return ApiResponse::errorResponse('Verification code expired!', Response::HTTP_UNAUTHORIZED);
        }
        return ApiResponse::successResponse('OK', Response::HTTP_OK);
    }
}
