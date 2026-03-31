<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EndTripRequest extends FormRequest
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
            'end_trip_location' => ['required', 'string', 'max:255'],
            'total_price' => ['required',  'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'total_distance_covered' => ['required', 'integer']
        ];
    }
}
