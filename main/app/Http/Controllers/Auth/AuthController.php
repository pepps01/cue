<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLoginRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\GoogleAuthRequest;
use App\Http\Requests\VerifyCodeRequest;
use App\Http\Resources\UserResource;
use App\Models\BankInformation;
use App\Models\User;
use App\Models\VerificationCode;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Traits\Generics;
use App\Traits\ProfileTrait;
use App\Traits\VerificationTraits;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    use VerificationTraits;
    use ProfileTrait;
    use Generics;

    //login function
    public function login(CreateLoginRequest $request, string $application_name)
    {
        $data =  $request->validated();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'application_name' => $application_name])) {
            $accessToken = Auth::user()->createToken('Auth Token')->accessToken;

            if (auth()->user()->is_active == 0) {
                return ApiResponse::errorResponse('Unauthorized!, Your account has been deactivated, please contact the administrator', Response::HTTP_UNAUTHORIZED);
            }
            //store device token
            if (isset($data['device_token'])) {
                $this->store_device_token(auth()->user(), $data);
            }
            return ApiResponse::successResponseWithData(new UserResource(auth()->user()), 'Login successful', Response::HTTP_OK, $accessToken);
        }

        return ApiResponse::errorResponse('Invalid Login credentials', Response::HTTP_UNAUTHORIZED);
    }

    //register function
    public function register(CreateUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $data['ref_code'] = $this->uniqueRefCode('users', $data['firstname']);

        // Log::info("Creating". $data["ref_code"]);
        //store user here
        $createUser = $this->storeUser($data);

        //give ref rewards to the parent user
        if (isset($data['ref_by'])) {
            $this->reward_ref_bonus($data['ref_by']);
        }
        //create user profile
        $createProfile = $this->create_profile($createUser, $data);

        //store device token
        if (isset($data['device_token'])) {
            $this->store_device_token($createUser, $data);
        }

        $userResource = new UserResource($createUser);
        $accessToken = $userResource->createToken('Auth Token')->accessToken;
        return ApiResponse::successResponseWithData($userResource, 'Registration was successful', Response::HTTP_CREATED, $accessToken);
    }


    public function redirectSocial($provider, GoogleAuthRequest $request)
    {
        $data = $request->validated();
        return Socialite::driver($provider)->stateless()
            ->with(['state' => 'role=' . $data['role'] . ':' . $data['application_name'] . ''])
            ->redirect();
    }

    public function callbackSocial(Request $request, $provider)
    {
        try {
            $access_token = Socialite::driver($provider)->getAccessTokenResponse($request->code);
            $providerUser = Socialite::driver($provider)->userFromToken($access_token['access_token']);

            $provider_id = $providerUser->id;
            $findUser = User::where('provider_id', $provider_id)->first();
            if ($findUser) {
                $userResource = new UserResource($findUser);
                $message = "Login was successfull";
            } else {
                //check if email already exists to avoid conflict
                $findEmail = User::where('email', $providerUser->getEmail())->first();
                if ($findEmail) {
                    return ApiResponse::errorResponse('Email has already been taken', Response::HTTP_CONFLICT);
                }

                //proceed to create an account for user if email doesn't exist already
                parse_str($request->state, $result);
                $explodeRole = explode(':', $result['role']);
                $explodeName = explode(' ', $providerUser->getName());
                $data = [
                    'firstname' => $explodeName[0],
                    'lastname' => $explodeName[1],
                    'email' => $providerUser->getEmail(),
                    'provider_id' => $provider_id,
                    'provider' => $provider,
                    'role' => $explodeRole[0],
                    'application_name' => $explodeRole[1],
                    'image' => $providerUser->getAvatar()
                ];
                //store user function here
                $createUser = $this->storeUser($data);
                $userResource = new UserResource($createUser);
                $message = "Registration was successfull";
            }

            $accessToken = ($findUser ?? $createUser)->createToken('Auth Token')->accessToken;
            return ApiResponse::successResponseWithData($userResource, $message, Response::HTTP_CREATED, $accessToken);
        } catch (Exception $e) {
            return ApiResponse::errorResponse($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }
    }


}
