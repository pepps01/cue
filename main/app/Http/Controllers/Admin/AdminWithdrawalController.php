<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWithdrawRequest;
use App\Http\Resources\WithdrawalResource;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WithdrawalRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminWithdrawalController extends Controller
{
    use ApiResponse;

    public function getAllWithdrawals()
    {
        $withdrawals = WithdrawalRequest::orderBy('created_at', 'DESC')->get();
        $withdrawalResource = WithdrawalResource::collection($withdrawals);
        return ApiResponse::successResponseWithData($withdrawalResource, "Withdrawal Records retrieved", Response::HTTP_OK);
    }

    public function getWithdrawalsByUser(User $user)
    {
        $withdrawals = WithdrawalRequest::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        $withdrawalResource = WithdrawalResource::collection($withdrawals);
        return ApiResponse::successResponseWithData($withdrawalResource, "Withdrawals by a " . $user->fullname . " retrieved", Response::HTTP_OK);
    }

    public function getByApplication(string $application_name)
    {
        $withdrawals = WithdrawalRequest::where('application_name', $application_name)->orderBy('created_at', 'DESC')->get();
        $withdrawalResource = WithdrawalResource::collection($withdrawals);
        return ApiResponse::successResponseWithData($withdrawalResource, "Withdrawals request from " . $application_name . " was retrieved successfully", Response::HTTP_OK);
    }

    public function getSingleWithdrawal(WithdrawalRequest $withdrawal)
    {
        $withdrawalResource = new WithdrawalResource($withdrawal);
        return ApiResponse::successResponseWithData($withdrawalResource, "Withdrawal Details retrieved", Response::HTTP_OK);
    }

    public function createWithdrawal(User $user, CreateWithdrawRequest $request)
    {
        if ($user->role == "consumer" || $user->role == "admin" || $user->role == "superadmin") {
            return ApiResponse::errorResponse("This user is not eligible to make withdrawals", Response::HTTP_FORBIDDEN);
        }
        $data = $request->validated();

        $wallet = Wallet::where('user_id', $user->id)->first();
        if ($wallet['withdrawable_amount'] < $data['amount']) {
            return ApiResponse::errorResponse("Insufficient wallet Balance", Response::HTTP_BAD_REQUEST);
        }

        $data['user_id'] = $user->id;
        $data['application_name'] = $user->application_name;
        $data['fullname'] = $user->fullname;
        $data['status'] = "Pending";

        $withdrawal = WithdrawalRequest::create($data);
        $withdrawResource = new WithdrawalResource($withdrawal);
        saveAdminActivityLog("withdrawal_created", "WithdrawalRequest", $withdrawal->id);
        return ApiResponse::successResponseWithData($withdrawResource, "Withdrawal Request submitted successfully for " . $user->fullname, Response::HTTP_CREATED);
    }

    public function acceptWithdrawal(WithdrawalRequest $withdrawal)
    {
        $withdrawal->update([
            'status' => "Accepted"
        ]);
        $withdrawalResource = new WithdrawalResource($withdrawal);
        saveAdminActivityLog("withdrawal_accepted", "WithdrawalRequest", $withdrawal->id);
        return ApiResponse::successResponseWithData($withdrawalResource, "Withdrawal request has been accepted and ready for disbursing", Response::HTTP_ACCEPTED);
    }

    public function rejectWithdrawal(WithdrawalRequest $withdrawal, Request $request)
    {
        $request->validate([
            'rejection_reason' => ['required', 'string', 'max:255']
        ]);
        $withdrawal->update([
            'status' => "Rejected",
            'rejection_reason' => $request->rejection_reason
        ]);
        $withdrawalResource = new WithdrawalResource($withdrawal);
        saveAdminActivityLog("withdrawal_rejected", "WithdrawalRequest", $withdrawal->id);
        return ApiResponse::successResponseWithData($withdrawalResource, 'Withdrawal request rejected', 200);
    }

    public function disburseFunds(WithdrawalRequest $withdrawal)
    {
        $wallet = Wallet::where('user_id', $withdrawal->user_id)->first();
        if ($withdrawal->status == "Disbursed") {
            return ApiResponse::errorResponse("Payment has already been made for this request", Response::HTTP_BAD_REQUEST);
        }

        if ($withdrawal->status != "Accepted") {
            return ApiResponse::errorResponse("Withdrawal request must be accepted before disbursing payment", Response::HTTP_BAD_REQUEST);
        }

        if ($wallet['withdrawable_amount'] < $withdrawal->amount) {
            return ApiResponse::errorResponse("Insufficient wallet balance", Response::HTTP_BAD_REQUEST);
        }

        //payment with third party payment platform goes here

        $wallet->update([
            'withdrawable_amount' => $wallet['withdrawable_amount'] - $withdrawal->amount
        ]);

        $withdrawal->update([
            'status' => "Disbursed"
        ]);
        $withdrawalResource = new WithdrawalResource($withdrawal);
        saveAdminActivityLog("payment_disbursed", "WithdrawalRequest", $withdrawal->id);
        return ApiResponse::successResponseWithData($withdrawalResource, 'Payment has been disbursed successfully', Response::HTTP_OK);
    }

    public function deleteWithdrawal(WithdrawalRequest $withdrawal)
    {
        $withdrawal->delete();
        saveAdminActivityLog("withdrawal_deleted", "WithdrawalRequest", $withdrawal->id);
        return ApiResponse::successResponse("Withdrawal deleted successfully", Response::HTTP_OK);
    }
}
