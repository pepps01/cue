<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use App\Traits\ProfileTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminUserController extends Controller
{
    use ApiResponse;
    use ProfileTrait;
    public function getAllUsers()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        $userResource = UserResource::collection($users);
        return ApiResponse::successResponseWithData($userResource, "All Users Retrieved", Response::HTTP_OK);
    }

    public function getUsersByRole(string $role)
    {
        $users = User::where('role', $role)->orderBy('created_at', 'DESC')->get();
        $userResource = UserResource::collection($users);
        return ApiResponse::successResponseWithData($userResource, "All " . $role . "s Retrieved", Response::HTTP_OK);
    }

    public function createUser(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        if ($data['role'] == "admin" || $data['role'] == "superadmin") {
            if (auth()->user()->role != "superadmin") {
                return ApiResponse::errorResponse("Only a superadmin can create another admin or superadmin", Response::HTTP_FORBIDDEN);
            }
        }

        //store user here
        $createUser = $this->storeUser($data);

        //create user profile
        $createProfile = $this->create_profile($createUser, $data);

        $userResource = new UserResource($createUser);
        $accessToken = $userResource->createToken('Auth Token')->accessToken;
        saveAdminActivityLog("user_created", "User", $createUser->id);
        return ApiResponse::successResponseWithData($userResource, 'User was created Successfully and User password is: ' . $request->password, Response::HTTP_CREATED, $accessToken);
    }

    public function getSingleUser(User $user)
    {
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Single User Retrieved", Response::HTTP_OK);
    }

    public function verifyEmail(User $user)
    {
        if ($user['email_verified_at'] != NULL) {
            return ApiResponse::errorResponse("User has been verified already", Response::HTTP_ALREADY_REPORTED);
        }
        if ($user['role'] == "admin" || $user['superadmin']) {
            if (auth()->user()->role != "superadmin") {
                return ApiResponse::errorResponse("Only a superadmin can verify another admin or superadmin", Response::HTTP_FORBIDDEN);
            }
        }
        $user->update([
            'email_verified_at' => Carbon::now()
        ]);

        $userResource = new UserResource($user);
        saveAdminActivityLog("user_verify_email", "User", $user->id);
        return ApiResponse::successResponseWithData($userResource, "User verified successfully", Response::HTTP_OK);
    }

    public function unverifyEmail(User $user)
    {
        if ($user['email_verified_at'] == NULL) {
            return ApiResponse::errorResponse("User is not verified", Response::HTTP_BAD_REQUEST);
        }
        if ($user['role'] == "admin" || $user['superadmin']) {
            if (auth()->user()->role != "superadmin") {
                return ApiResponse::errorResponse("Only a superadmin can unverify another admin or superadmin", Response::HTTP_FORBIDDEN);
            }
        }
        $user->update([
            'email_verified_at' => NULL
        ]);

        $userResource = new UserResource($user);
        saveAdminActivityLog("user_unverify_email", "User", $user->id);
        return ApiResponse::successResponseWithData($userResource, "User unverified successfully", Response::HTTP_OK);
    }

    public function activateUser(User $user)
    {
        if ($user['is_active'] == true) {
            return ApiResponse::errorResponse("User is still active", Response::HTTP_BAD_REQUEST);
        }
        if ($user['role'] == "admin" || $user['superadmin']) {
            if (auth()->user()->role != "superadmin") {
                return ApiResponse::errorResponse("Only a superadmin can activate another admin or superadmin", Response::HTTP_FORBIDDEN);
            }
        }
        $user->update([
            'is_active' => true
        ]);
        $userResource = new UserResource($user);
        saveAdminActivityLog("user_acivated", "User", $user->id);
        return ApiResponse::successResponseWithData($userResource, "User activated successfully", Response::HTTP_OK);
    }

    public function deactivateUser(User $user)
    {
        if ($user['is_active'] != true) {
            return ApiResponse::errorResponse("User is already inactive", Response::HTTP_BAD_REQUEST);
        }
        if ($user['role'] == "admin" || $user['superadmin']) {
            if (auth()->user()->role != "superadmin") {
                return ApiResponse::errorResponse("Only a superadmin can activate another admin or superadmin", Response::HTTP_FORBIDDEN);
            }
        }
        $user->update([
            'is_active' => false
        ]);
        $userResource = new UserResource($user);
        saveAdminActivityLog("user_deactivated", "User", $user->id);
        return ApiResponse::successResponseWithData($userResource, "User deactivated successfully", Response::HTTP_OK);
    }

    public function deleteUser(User $user)
    {
        if ($user['role'] == "admin" || $user['superadmin']) {
            if (auth()->user()->role != "superadmin") {
                return ApiResponse::errorResponse("Only a superadmin can delete another admin or superadmin", Response::HTTP_FORBIDDEN);
            }
        }
        $user->delete();
        saveAdminActivityLog("user_deleted", "User", $user->id);
        return ApiResponse::successResponse("User has been deleted", Response::HTTP_OK);
    }
}
