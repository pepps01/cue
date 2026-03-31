<?php

use App\Models\BankCardInfo;
use App\Models\UserDeviceToken;
use Illuminate\Support\Facades\Http;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Response;


if (!function_exists('verifyPayment')) {
    /**
     * @param  object $data
     * @return json $result
     */

    function verifyPayment($data)
    {
        try {
            $response = Http::acceptJson()
                ->withHeaders([
                    'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
                ])
                ->get(env('PAYSTACK_BASE_URL') . '/transaction/verify/' . $data['payment_reference']);

            return json_decode($response, true);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}

if (!function_exists('verifyPaymentFlutterwave')) {
    /**
     * @param  object $data
     * @return json $result
     */

    function verifyPaymentFlutterwave($data)
    {
        $transID = $data['transaction_id'];
        try {
            $response = Http::acceptJson()
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer " . env('FLW_SECRET_KEY'),
                ])
                ->get(env("FLW_BASE_URL") . "/transactions/$transID/verify");

            return json_decode($response, true);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}

if (!function_exists('initiateCardCharge')) {

    /**
     * @param  array $data
     * @return json $result
     */

    function initiateCardCharge($data)
    {
        try {
            $data['email'] = auth()->user()->email;
            $data['amount'] = 100 * 100;

            //charge card and save card information
            $data['card'] = [
                'number' => $data['card_number'],
                'cvv' => $data['cvv'],
                'expiry_month' => $data['expiry_month'],
                'expiry_year' => $data['expiry_year'],
            ];

            $response = Http::acceptJson()
                ->withHeaders([
                    'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
                ])
                ->post(env('PAYSTACK_BASE_URL') . '/charge', $data);
            return json_decode($response, true);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}


if (!function_exists('chargeAuthorization')) {
    /**
     * @param  string $email
     * @param  string $amount
     * @return json $result
     */

    function chargeAuthorization($data)
    {
        try {
            $amount = ($data['amount'] * 100);
            $data = [
                "authorization_code" => $data['authorization_code'],
                "email" => auth()->user()->email,
                "amount" => $amount
            ];
            $response = Http::acceptJson()
                ->withHeaders([
                    'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
                ])
                ->post(env('PAYSTACK_BASE_URL') . '/transaction/charge_authorization', $data);

            return json_decode($response, true);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}

if (!function_exists('verifyBankAccount')) {
    /**
     * @param  string $account_number
     * @param  string $bank_code
     * @return json $result
     */

    function verifyBankAccount($account_number, $bank_code)
    {
        try {
            $response = Http::acceptJson()
                ->withHeaders([
                    'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
                ])
                ->get(env('PAYSTACK_BASE_URL') . '/bank/resolve/?account_number=' . $account_number . '&bank_code=' . $bank_code);

            return json_decode($response, true);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}

if (!function_exists('verifyDriversLicense')) {

    /**
     * @param  string $license_no
     * @return json $result
     */

    function verifyDriversLicense($license_no)
    {
        try {
            $data = [
                'id' => $license_no,
                'metadata' => [
                    'requestId' => rand(10000000, 99999999),
                ],
                'isSubjectConsent' => true,
                // "validations" => [
                //     "data" => [
                //         "lastName" => auth()->user()->lastname,
                //         "firstName" => auth()->user()->firstname,
                //         "dateOfBirth" => auth()->user()->date_of_birth
                //     ]
                // ]
            ];
            $response = Http::acceptJson()
                ->withHeaders([
                    'token' => env('YOUVERIFY_API_KEY'),
                    'Content-Type' => 'application/json'
                ])
                ->post(env('YOUVERIFY_BASE_URL') . '/v2/api/identity/ng/drivers-license', $data);

            $result = json_decode($response, true);
            if ($result['success'] == false) {
                abort(ApiResponse::errorResponse($result['message'], $result['statusCode']));
            } else {
                return $result;
            }
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}

if (!function_exists('geocode_api')) {
    /**
     * @param  string $address
     * @return json placeid, long, lat
     */

    function geocode_api($address)
    {
        try {
            $get_place = Http::get('https://maps.googleapis.com/maps/api/place/autocomplete/json?input=' . $address . '&key=' . env('GOOGLE_MAPS_API_KEY'));
            $place = json_decode($get_place, true);
            $place_id = $place['predictions'][0]['place_id'];

            $get_cordinates = Http::get('https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $place_id . '&key=' . env('GOOGLE_MAPS_API_KEY'));
            $cordinates = json_decode($get_cordinates, true);
            $lat = $cordinates['result']['geometry']['location']['lat'];
            $long = $cordinates['result']['geometry']['location']['lng'];

            return [
                'lat' => $lat,
                'long' => $long,
                'place_id' => $place_id
            ];
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}

if (!function_exists('getBanks')) {
    function getBanks()
    {
        try {
            $response = Http::acceptJson()
                ->withHeaders([
                    'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
                ])
                ->get(env('PAYSTACK_BASE_URL') . '/bank');

            return $response;
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}

if (!function_exists('firebase_push_notification')) {
    /**
     * @param  string $userId
     * @param  object $data
     */
    function firebase_push_notification($userId, $data)
    {
        $getDeviceToken = UserDeviceToken::where('user_id', $userId)->orderBy('updated_at', 'DESC')->first();
        try {
            $token = $getDeviceToken['device_token'];
            $postData = [];
            $postData['to'] = $token;
            $postData['notification']['body'] = $data['body'];
            $postData['notification']['title'] = $data['title'];
            $postData['notification']['subtitle'] = $data['subtitle'] ?? null;
            $postData['data'] = $data['optional'] ?? null;

            $response = Http::acceptJson()
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => "key= " . config('constants.fcm_secret'),
                ])
                ->post('https://fcm.googleapis.com/fcm/send', $postData);

            $decodeRes = json_decode($response, true);
            if ($decodeRes['failure'] == 1 && $decodeRes['success'] == 0) {
                logger()->error($decodeRes['results']);
            }
            return $decodeRes;
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}


if (!function_exists('expo_push_notification')) {
    /**
     * @param  string $token
     * @param  object $data
     */
    function expo_push_notification($token, $title, $body)
    {
        try {
            $postData = [
                'to' => $token,
                'title' => $title,
                'body' => $body
            ];

            $response = Http::acceptJson()
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post('https://exp.host/--/api/v2/push/send', $postData);

            $decodeRes = json_decode($response, true);
            if ($decodeRes['data']['status'] != "ok") {
                logger()->error("Expo Push Notification Failed for token: $token");
            }
            return $decodeRes;
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}
