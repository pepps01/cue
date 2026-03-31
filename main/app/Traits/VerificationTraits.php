<?php

namespace App\Traits;

use App\Models\VerificationCode;
use App\Notifications\PasswordResetNotification;
use App\Notifications\VerificationCodeNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;

trait VerificationTraits
{
    public static function sendVerificationCode($email, $purpose, $firstname)
    {
        $code = random_int(100000, 999999);
        $deleteExistingCodes = VerificationCode::whereVerifiable($email)->delete();
        $hashedCode = Hash::make($code);

        $data = [
            'code' => $hashedCode,
            'verifiable' => $email,
            'expires_at' => Carbon::now()->addMinutes(10)->toDateTimeString()
        ];

        VerificationCode::create($data);

        if ($purpose == 'verification') {

            Notification::route('mail', $email)->notify((new VerificationCodeNotification($firstname, $code)));
        }

        if ($purpose == 'password') {
            Notification::route('mail', $email)->notify((new PasswordResetNotification($firstname, $code)));
        }
    }

    public static function verifyCode($code, $email)
    {
        $getCode = VerificationCode::where('verifiable', $email)->first();
        if ($getCode) {
            $existingCode = $getCode->code;
            $correctCode = Hash::check($code, $existingCode);
            if ($correctCode) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
