<?php

namespace App\Http\Requests;

use App\Rules\CheckActiveProduct;
use Illuminate\Foundation\Http\FormRequest;

class AdminCreateOrderRequest extends FormRequest
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
            'product' => ['array', 'required'],
            'product.*' => ['array', 'required'],
            'product.*.product_id' => ['integer', 'required', 'exists:products,id', new CheckActiveProduct],
            'product.*.quantity' => ['integer', 'required'],
            'product.*.delivery_charge' => ['integer', 'required'],
            'delivery_address' => ['required', 'string'],
            'phone' => ['required', 'numeric'],
            'amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }
}
