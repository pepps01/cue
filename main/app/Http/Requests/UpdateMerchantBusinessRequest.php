<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMerchantBusinessRequest extends FormRequest
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
            //specifically for the user table
            'firstname' =>  ['nullable', 'string', 'max:255'],
            'lastname' =>  ['nullable', 'string', 'max:255'],
            'email' =>  [
                'nullable', 'email', 'max:255', Rule::unique('users', 'email')->where(function ($query) use ($user) {
                    return $query->where('id', '<>', $user->id)
                        ->where('application_name', $user->application_name);
                })
            ],
            'phone' => ['nullable', 'numeric', Rule::unique('users', 'phone')->where(function ($query) use ($user) {
                return $query->where('id', '<>', $user->id)
                    ->where('application_name', $user->application_name);
            })],
            'address' => ['nullable', 'string'],
            'country_id' => ['nullable', 'integer', 'exists:countries,id'],
            'state_id' => ['nullable', 'integer', 'exists:states,id'],
            'lga_id' => ['nullable', 'integer', 'exists:lgas,id'],
            'gender' => ['nullable', 'string', Rule::in(['Male', 'Female'])],
            'date_of_birth' => ['nullable', 'date'],

            // specifically for the merchant table
            'merchant_type' => ['nullable', 'string', Rule::in(['business'])],
            'category' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
            'cac_document' => ['nullable', 'mimes:png,jpg,jpeg,gif,svg', 'max:10240'],
            'cac_number' => ['nullable', 'string'],
            'identity_type' => ['nullable', 'string'],
            'identity_document' => ['nullable', 'mimes:png,jpg,jpeg,gif,svg', 'max:10240'],
        ];
    }
}
