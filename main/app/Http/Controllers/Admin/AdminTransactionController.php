<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminTransactionController extends Controller
{
    use ApiResponse;

    public function getAllTransactions()
    {
        $transactions = Transaction::orderby('created_at', 'DESC')->get();
        $transactionResource = TransactionResource::collection($transactions);
        return ApiResponse::successResponseWithData($transactionResource, "All Transactions Retrieved", Response::HTTP_OK);
    }

    public function getTransactionsByUser(User $user)
    {
        $transactions = Transaction::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        $transactionResource = TransactionResource::collection($transactions);
        return ApiResponse::successResponseWithData($transactionResource, "All Transactions by " . $user->fullname . " retrieved", Response::HTTP_OK);
    }

    public function getByApplication(string $application_name)
    {
        $transactions = Transaction::where('application_name', $application_name)->orderBy('created_at', 'DESC')->get();
        $transactionResource = TransactionResource::collection($transactions);
        return ApiResponse::successResponseWithData($transactionResource, "Transaction on " . $application_name . " was retrieved successfully", Response::HTTP_OK);
    }

    public function getByPaymentMethod(string $payment_method)
    {
        $transactions = Transaction::where('payment_method', $payment_method)->orderBy('created_at', 'DESC')->get();
        $transactionResource = TransactionResource::collection($transactions);
        return ApiResponse::successResponseWithData($transactionResource, "Transaction performed using the payment method: " . $payment_method . " was retrieved successfully", Response::HTTP_OK);
    }

    public function singleTransaction(Transaction $transaction)
    {
        $transactionResource = new TransactionResource($transaction);
        return ApiResponse::successResponseWithData($transactionResource, "Transaction Details retrieved", Response::HTTP_OK);
    }

    public function deleteTransaction(Transaction $transaction)
    {
        $transaction->delete();
        return ApiResponse::successResponse("Transaction was deleted successfully", Response::HTTP_OK);
    }
}
