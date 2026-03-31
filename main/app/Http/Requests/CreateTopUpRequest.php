<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTopUpRequest extends FormRequest
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
            'amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'payment_reference' => ['nullable', 'string', 'unique:transactions,payment_reference'],
            'transaction_id' => ['required', 'string', 'unique:transactions,transaction_id'],
            // 'card_id'=>['required', 'string', 'exists:bank_card_infos,id'],
        ];
    }

    public function messages()
    {
        return [
            'payment_reference.unique' => "The payment reference has already been used"
        ];
    }
}
