<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCardRequest extends FormRequest
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
            'card_number' => ['required', 'numeric'],
            'expiry_date' => ['required', 'date_format:m/y', 'after_or_equal:today'],
            'cvv' => ['required', 'numeric'],
            'authorization' => ['required', 'string']
        ];
    }
}
