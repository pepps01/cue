<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMealRequest extends FormRequest
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
            'name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'array'],
            'image.*' => ['nullable', 'mimes:png,jpg,jpeg,gif,svg,jfif', 'max:10240'],
            'price' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'price_desc' => ['nullable', 'string'],
            'is_pack_required' => ['nullable',  Rule::in(['0', '1'])],
            'pack_price' => ['required_if:is_pack_required,==,1', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/']
        ];
    }
}
