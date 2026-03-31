<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyDriverRequest extends FormRequest
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
            'drivers_licence_number' => ['required', 'string', 'size:12'],
            'drivers_licence_front' => ['required', 'string'],
            'drivers_licence_back' => ['required', 'string']
        ];
    }
}
