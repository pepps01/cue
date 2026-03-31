<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:255'],
            'brand' => ['nullable', 'string', 'max:255'],
            'price' =>  ['nullable', 'regex:/^\d+(\.\d{1,2})?$/', 'numeric'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required_with:brand', 'string', 'exists:product_categories,id'],
            'quantity' => ['nullable', 'integer'],
            'free_delivery' =>  ['nullable', 'string', Rule::in(['Yes', 'No'])],
            'shipping_fee' => ['required_if:free_delivery,==,No', 'regex:/^\d+(\.\d{1,2})?$/'],
            'product_warranty' => ['nullable', 'string'],
            'discount_available' => ['required_with:price', 'string', Rule::in(["Yes", "No"])],
            'discount_percentage' => ['required_if:discount_available,==,Yes', 'regex:/^\d+(\.\d{1,2})?$/', 'numeric', 'between:1,100']
        ];
    }
}
