<?php

namespace App\Http\Requests;

use App\Rules\CheckActiveProductCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'price' =>  ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'numeric'],
            'description' => ['nullable', 'string'],
            'weight' => ['nullable', 'regex:/^\d+(\.\d{1,2})?$/'],
            'category_id' => ['required', 'string', 'exists:product_categories,id', new CheckActiveProductCategory],
            'quantity' => ['required', 'integer'],
            'free_delivery' =>  ['required', 'string', Rule::in(['Yes', 'No'])],
            'shipping_fee' => ['required_if:free_delivery,==,No', 'regex:/^\d+(\.\d{1,2})?$/'],
            'product_warranty' => ['nullable', 'string'],
            'discount_available' => ['required', 'string', Rule::in(["Yes", "No"])],
            'discount_percentage' => ['required_if:discount_available,==,Yes', 'regex:/^\d+(\.\d{1,2})?$/', 'numeric', 'between:1,100']
        ];
    }
}
