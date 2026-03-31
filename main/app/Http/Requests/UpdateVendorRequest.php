<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVendorRequest extends FormRequest
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
        $user = User::find(auth()->user()->id);
        return [
            'firstname' =>  ['nullable', 'string', 'max:255'],
            'lastname' =>  ['nullable', 'string', 'max:255'],
            'business_email' =>  [
                'nullable', 'email', 'max:255', Rule::unique('users', 'email')->where(function ($query) use ($user) {
                    return $query->where('id', '<>', $user->id)
                        ->where('application_name', $user->application_name);
                })
            ],
            'business_phone' => ['nullable', 'numeric', Rule::unique('users', 'phone')->where(function ($query) use ($user) {
                return $query->where('id', '<>', $user->id)
                    ->where('application_name', $user->application_name);
            })],
            'business_location' => ['nullable', 'string'],

            //specific to cue chow vendors
            'business_name' => ['nullable', 'string'],
            'business_type' => ['nullable', 'string', Rule::in('restaurant', 'supermarket', 'pharmacy')],
            'restaurant_type_id' => ['required_if:business_type,==,restaurant', 'numeric', 'exists:restaurant_types,id'],
            'no_of_stores' => ['nullable', 'numeric'],
            'delivery_type' => ['nullable', 'string', Rule::in('instant', 'pre_order', 'both')],
            'tax_id' => ['nullable', 'string'],
            'opening_days' => ['nullable', 'array'],
            'opening_days.*' => ['required', 'string'],
            'opening_hours' => ['nullable', 'string'],
            'closing_hours' => ['nullable', 'string']
        ];
    }
}
