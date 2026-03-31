<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'service_name' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'string', 'exists:service_categories,id'],
            'years_of_exp' => ['nullable', 'integer'],
            'amount' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'numeric'],
            'other_details' => ['nullable', 'json'],
            'description' => ['nullable', 'string']
        ];
    }
}
