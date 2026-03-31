<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDriverRequest extends FormRequest
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
        ];
    }
}
