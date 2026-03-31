<?php

namespace App\Http\Requests;

use App\Rules\CheckActiveMerchantCategory;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstname' =>  ['required', 'string', 'max:255'],
            'lastname' =>  ['required', 'string', 'max:255'],
            'email' =>  ['required', 'email', 'max:255', Rule::unique("users", 'email')->where('application_name', $this->application_name)],
            'phone' =>  ['required', 'numeric', Rule::unique("users", 'phone')->where('application_name', $this->application_name)],
            'password' =>  ['required', 'string', 'max:255', 'min:6'],
            'role' => ['required', 'string', Rule::in(['consumer', 'driver', 'rider', 'merchant', 'superadmin', 'admin', 'vendor'])],
            'application_name' => ['required', 'string', Rule::in(['flip', 'cue', 'cueDriver', 'admin', 'cueChowVendor'])],
            'gender' => ['nullable', 'string', Rule::in(['Male', 'Female'])],
            'category' => ['required_if:role,==,merchant', 'string', 'exists:merchant_categories,id', new CheckActiveMerchantCategory],
            'merchant_type' => ['required_if:role,==,merchant', Rule::in(['personal', 'business'])],
            'date_of_birth' => [
                'required_if:role,==,driver',  'date_format:Y-m-d', 'before:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            ],
            'address' => ['required_if:role,==,rider,driver,vendor', 'string'],
            'country_id' => ['required_if:role,==,rider,driver', 'integer', 'exists:countries,id'],
            'state_id' => ['required_if:role,==,rider,driver', 'integer', 'exists:states,id'],
            'lga_id' => ['nullable', 'integer', 'exists:lgas,id'],
            'ref_by' => ['nullable', 'string', 'exists:users,ref_code'],
            'device_token' => ['nullable', 'string'],
            'business_name' => ['required_if:role,==,vendor', 'string'],
            'business_type' => ['required_if:role,==,vendor', 'string', Rule::in('restaurant', 'supermarket', 'pharmacy')],
            'restaurant_type_id' => ['required_if:business_type,==,restaurant', 'numeric', 'exists:restaurant_types,id'],
            'no_of_stores' => ['required_if:role,==,vendor', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'date_of_birth.before' => "Sorry, only those upto 18 years of age can proceed"
        ];
    }
}
