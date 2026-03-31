<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PayTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'payment_method' => ['required', Rule::in('wallet', 'paystack', 'flw', 'card')],
            'payment_reference' => ['required_if:payment_method,==,paystack', 'string', 'unique:transactions,payment_reference'],
            'transaction_id' => ['required_if:payment_method,==,flw', 'string', 'unique:transactions,transaction_id'],
            'card_id' => ['required_if:payment_method,==,card', 'string', 'unique:bank_card_infos,id'],
            'amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'tip_amount' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/']
        ];
    }
}
