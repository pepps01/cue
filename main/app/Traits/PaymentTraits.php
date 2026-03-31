<?php

namespace App\Traits;

use App\Models\BankCardInfo;
use App\Models\Transaction;
use App\Models\Wallet;
use Symfony\Component\HttpFoundation\Response;


trait PaymentTraits
{
    public function pay_with_wallet($data, $purpose)
    {
        $wallet = Wallet::where('user_id', auth()->user()->id)->first();
        if ($wallet['withdrawable_amount'] < $data['amount']) {
            abort(ApiResponse::errorResponse("Insufficient wallet Balance", Response::HTTP_BAD_REQUEST));
        }

        $wallet->update([
            'withdrawable_amount' => $wallet['withdrawable_amount'] - $data['amount']
        ]);

        return $this->create_trans_history($data['amount'], "wallet", $purpose, NULL, "successfull");
    }

    public function pay_with_paystack($data, $purpose)
    {
        $payment = verifyPayment($data);

        if ($payment['status'] != true) {
            abort(ApiResponse::errorResponse("Payment reference is not Valid", Response::HTTP_NOT_FOUND));
        }

        if ($payment['data']['status'] != "success") {
            abort(ApiResponse::errorResponse("Payment has not been completed", Response::HTTP_BAD_REQUEST));
        }

        $this->create_trans_history($data['amount'], "paystack", $purpose, $data['payment_reference'], "successfull");
        return $payment;
    }

    public function pay_with_flw($data, $purpose)
    {
        $payment = verifyPaymentFlutterwave($data);
        if ($payment['status'] == "error") {
            abort(ApiResponse::errorResponse($payment['message'], Response::HTTP_NOT_FOUND));
        }

        if ($payment['data']['status'] == null) {
            abort(ApiResponse::errorResponse($payment['message'], Response::HTTP_BAD_REQUEST));
        }

        $this->create_trans_history($data['amount'], "flw", $purpose, null, $data['transaction_id'], "successfull", $data['transaction_id']);
        return $payment;
    }

    public function pay_with_card($data, $purpose)
    {
        $get_card = BankCardInfo::where('id', $data['card_id'])->where('user_id', auth()->user()->id)->first();
        if (!$get_card) {
            abort(ApiResponse::errorResponse("Card is Invalid", Response::HTTP_NOT_FOUND));
        }
        $decode_card = json_decode($get_card['authorization'], true);
        $data['authorization_code'] = $decode_card['authorization_code'];

        $payment = chargeAuthorization($data);

        if ($payment['status'] != true) {
            abort(ApiResponse::errorResponse($payment['message'], Response::HTTP_NOT_FOUND));
        }

        $this->create_trans_history($data['amount'], "card", $purpose, NULL, "successfull");
        return $payment;
    }

    public function create_card_authorization($data, $purpose)
    {
        $payment = initiateCardCharge($data);
        if ($payment['status'] != true) {
            abort(ApiResponse::errorResponse($payment['message'] . ", " . $payment['data']['message'], Response::HTTP_BAD_GATEWAY));
        }
        $this->create_trans_history(100, "paystack", $purpose, $payment['data']['reference'], "successfull");
        return $payment;
    }


    public function create_trans_history($amount, $payment_method, $purpose, $payment_reference, $status, $user = null, $tran_id = null)
    {
        Transaction::create([
            'serial' => uniqueRandomChar('transactions', 'serial', 8),
            'user_id' => $user->id ?? auth()->user()->id,
            'fullname' => $user->fullname ?? auth()->user()->fullname,
            'application_name' => $user->application_name ?? auth()->user()->application_name,
            'amount' => $amount,
            'payment_method' => $payment_method,
            'purpose' => $purpose,
            'payment_reference' => $payment_reference,
            'transaction_id' => $tran_id,
            'status' => $status
        ]);
    }

    public function verify_bank_account($account_number, $bank_code)
    {
        $verify_account = verifyBankAccount($account_number, $bank_code);

        if ($verify_account['status'] != true) {
            abort(ApiResponse::errorResponse($verify_account['message'], Response::HTTP_NOT_FOUND));
        }

        return $verify_account;
    }
}
