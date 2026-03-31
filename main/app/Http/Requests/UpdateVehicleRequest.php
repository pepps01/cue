<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleRequest extends FormRequest
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
            'manufacturer' => ['nullable', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'year' => ['required', 'numeric', 'digits:4', 'gte:2002'],
            'color' => ['nullable', 'string'],
            'plate_number' => ['nullable', 'string'],
            'plate_number_on_car_photo' => ['nullable', 'string'],
            'car_interior_photo' => ['nullable', 'string'],
            'car_exterior_photo' => ['nullable', 'string']
        ];
    }

    public function messages()
    {
        return [
            'year.gte' => "Vehicle is too old, only vehicles from year 2002 is allowed"
        ];
    }
}
