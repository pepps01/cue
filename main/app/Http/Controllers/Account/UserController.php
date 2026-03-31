<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateCardRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Http\Requests\UpdateProfilePictureRequest;
use App\Http\Resources\BankCardResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserResource;
use App\Models\BankCardInfo;
use App\Models\BankInformation;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Traits\PaymentTraits;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    use PaymentTraits;

    //get User Profile
    public function getProfile()
    {
        $user = User::find(auth()->user()->id);
        return ApiResponse::successResponseWithData(new UserResource($user), "User Profile retrieved", Response::HTTP_OK);
    }

    //get user's profile by ID
    public function getUserProfile(User $user)
    {
        return ApiResponse::successResponseWithData(new UserResource($user), "User Profile retrieved", Response::HTTP_OK);
    }

    //change user password
    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::find(auth()->user()->id);

        $user->update([
            'password' => Hash::make($data['password'])
        ]);
        return ApiResponse::successResponseWithData(new UserResource($user), "Password updated successfully", Response::HTTP_OK);
    }

    //update user profile
    public function updateProfilePicture(UpdateProfilePictureRequest $request)
    {
        $data = $request->validated();
        $user = User::find(auth()->user()->id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = pushFileToStorage($image, 'profile');
        }
        if ($request->has('image_encoded')) {
            $data['image'] = pushFileStringToStorage($data['image_encoded'], 'profile');
        }

        $user->update($data);
        return ApiResponse::successResponseWithData(new UserResource($user), "Profile Picture updated successfully", Response::HTTP_OK);
    }

    //update bank info
    public function updateBankInfo(UpdateBankRequest $request)
    {
        $data = $request->validated();
        $userBank = BankInformation::where('user_id', auth()->user()->id)->first();

        // //verify bank account infomartion
        // $bank = Bank::find($data['bank_id']);
        // $verify = $this->verify_bank_account($data['account_number'], $bank['paystack_code']);
        // $data['account_name'] = $verify['data']['account_name'];

        $userBank->update($data);
        return ApiResponse::successResponseWithData(new UserResource($userBank->user), "Payment info Updated successfully", Response::HTTP_OK);
    }

    //get my cards
    public function allCards()
    {
        $cards = BankCardInfo::where('user_id', auth()->user()->id)->get();
        return ApiResponse::successResponseWithData(BankCardResource::collection($cards), "All cards retrieved", Response::HTTP_OK);
    }

    //add card details
    public function storeCard(CreateCardRequest $request)
    {
        $data = $request->validated();
        $exp_date = explode('/', $data['expiry_date']);
        $data['expiry_month'] = $exp_date[0];
        $data['expiry_year'] = $exp_date[1];
        $data['user_id'] = auth()->user()->id;
        $data['cvv'] = Hash::make($data['cvv']);
        $data['authorization'] = stripslashes($data['authorization']);
        $new_card = BankCardInfo::create($data);
        return ApiResponse::successResponseWithData(new BankCardResource($new_card), "Card was added successfully", Response::HTTP_OK);
    }

    public function singleCard(BankCardInfo $card)
    {
        return ApiResponse::successResponseWithData(new BankCardResource($card), "Card Details retrieved", Response::HTTP_OK);
    }

    public function removeCard(BankCardInfo $card)
    {
        $card->delete();
        return ApiResponse::successResponse("Card has been removed", Response::HTTP_OK);
    }

    //fetch notifications
    public function getNotifications()
    {
        $notifications = Notification::where('receiver_user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        return ApiResponse::successResponseWithData(NotificationResource::collection($notifications), "User Notificatinos Retrieved", Response::HTTP_OK);
    }

    //toggle notification
    public function toggleNotification($status)
    {
        $user = User::find(auth()->user()->id);
        $user->update([
            'is_notify' => $status == "true" ? 1 : 0
        ]);
        return ApiResponse::successResponse("Successfull", Response::HTTP_OK);
    }

    //delete account
    public function deleteAccount()
    {
        $user = User::find(auth()->user()->id);

        //delete the user
        $user->profile->delete();
        $user->wallet->delete();
        $user->bank->delete();
        $user->cards()->delete();
        $user->communityChats()->delete();
        $user->chatComments()->delete();
        $user->devices()->delete();
        $user->delete();

        return ApiResponse::successResponse("Account removed Sucessfully", Response::HTTP_OK);
    }
}
