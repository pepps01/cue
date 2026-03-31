<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestTripRequest extends FormRequest
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
            'trip_duration' =>  ['required', 'numeric'],
            'base_price' =>  ['required', 'regex:/^\d+(\.\d{1,2})?$/', 'numeric'],
            'distance_to_pickup' =>  ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'duration_to_pickup' =>  ['required', 'numeric'],
            'request_location' =>  ['required', 'string', 'max:255'],
            'pickup_location' =>  ['required', 'string', 'max:255'],
            'dropoff_location' =>  ['required', 'string', 'max:255'],
        ];
    }
}
