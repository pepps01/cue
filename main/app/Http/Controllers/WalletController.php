<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTopUpRequest;
use App\Http\Requests\CreateWithdrawRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\WalletResource;
use App\Http\Resources\WithdrawalResource;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WithdrawalRequest;
use App\Traits\ApiResponse;
use App\Traits\PaymentTraits;
use Symfony\Component\HttpFoundation\Response;

class WalletController extends Controller
{
    use PaymentTraits;

    public function getWalletBalance()
    {
        $wallet = Wallet::where('user_id', auth()->user()->id)->first();
        $walletResource = new WalletResource($wallet);
        return ApiResponse::successResponseWithData($walletResource, "Wallet Balance retrieved successfully", Response::HTTP_OK);
    }

    public function topUpWallet(CreateTopUpRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();
        $userID = $user->id;
        $wallet = $user->wallet;

        $this->pay_with_flw($data, "Top-Up Wallet");
        // $this->pay_with_card($data, "Top-Up Wallet");
        $wallet->update(['withdrawable_amount' => $wallet['withdrawable_amount'] + $data['amount']]);

        newNotification($userID, $userID, $wallet->id, 'Wallet', config('constants.wallet.top.title'), config('constants.wallet.top.message'), true);

        return ApiResponse::successResponseWithData(new WalletResource($wallet), "Funds was added successfully", Response::HTTP_OK);
    }

    public function requestWithdrawal(CreateWithdrawRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();
        $userID = $user->id;
        $wallet = $user->wallet;

        $receiver = User::where('application_name', "admin")->first();
        if ($wallet['withdrawable_amount'] < $data['amount']) {
            return ApiResponse::errorResponse("Insufficient wallet Balance", Response::HTTP_BAD_REQUEST);
        }

        $data['user_id'] = $userID;
        $data['application_name'] = $user->application_name;
        $data['fullname'] = $user->fullname;
        $data['status'] = "Pending";

        $withdraw = WithdrawalRequest::create($data);

        newNotification($userID, $receiver->id, $wallet->id, 'Wallet', config('constants.wallet.request.title'), config('constants.wallet.request.message'), true);

        return ApiResponse::successResponseWithData(new WithdrawalResource($withdraw), "Withdrawal Request submitted successfully", Response::HTTP_CREATED);
    }

    public function withdrawalRequests()
    {
        $withdraws = WithdrawalRequest::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        return ApiResponse::successResponseWithData(WithdrawalResource::collection($withdraws), "Withdrawal Requests retrieved", Response::HTTP_OK);
    }

    public function singleWithdrawalRequest(WithdrawalRequest $withdraw)
    {
        return ApiResponse::successResponseWithData(new WithdrawalResource($withdraw), "Withdrawal Request Detail Retrieved successfully", Response::HTTP_CREATED);
    }

    public function deleteWithdrawalRequest(WithdrawalRequest $wallet)
    {
        $wallet->delete();
        return ApiResponse::successResponse("Withdrawal request was removed successfully", Response::HTTP_OK);
    }

    public function myTransactions()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        return ApiResponse::successResponseWithData(TransactionResource::collection($transactions), "All transactions retrieved", Response::HTTP_OK);
    }

    public function singleTransaction(Transaction $transaction)
    {
        return ApiResponse::successResponseWithData(new TransactionResource($transaction), "Single transaction retrieved", Response::HTTP_OK);
    }

    public function deleteTransaction(Transaction $transaction)
    {
        $transaction->delete();
        return ApiResponse::successResponse("Transaction removed Successfully", Response::HTTP_OK);
    }
}
