<?php

namespace App\Http\Requests;

use App\Rules\CheckActiveProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrderRequest extends FormRequest
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
            'cart' => ['array', 'required'],
            'cart.*' => ['array', 'required'],
            'cart.*.cart_id' => ['string', 'required', 'exists:carts,id'],
            'cart.*.delivery_charge' => ['string', 'required'],
            'payment_method' => ['required', 'string', Rule::in(['paystack', 'cash', 'wallet', 'card', 'paystack', 'flw'])],
            'state' => ['required', 'integer', 'exists:states,id'],
            'lga' => ['required', 'integer', 'exists:lgas,id'],
            'delivery_address' => ['required', 'string'],
            'phone' => ['required', 'numeric'],
            'amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'payment_reference' => ['required_if:payment_method,==,paystack', 'string', 'unique:transactions,payment_reference'],
            'transaction_id' => ['required_if:payment_method,==,flw', 'string', 'unique:transactions,transaction_id'],
            'card_id' => ['required_if:payment_method,==,card', 'string', 'unique:bank_card_infos,id'],
        ];
    }
}
