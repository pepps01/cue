<?php

namespace App\Http\Requests;

use App\Rules\CheckActiveServiceCategory;
use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
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
            'service_name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'exists:service_categories,id', new CheckActiveServiceCategory],
            'years_of_exp' => ['required', 'integer'],
            'amount' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'state' => ['nullable', 'integer', 'exists:states,id'],
            'lga' => ['nullable', 'integer', 'exists:lgas,id'],
            'phone_number' => ['required', 'numeric'],
            'other_details' => ['nullable', 'json'],
            'description' => ['nullable', 'string']
        ];
    }
}
