<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationRequest extends FormRequest
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
            'school_name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date_format:m/Y', 'max:255'],
            'end_date' => ['nullable', 'date_format:m/Y', 'after:start_date'],
            'degree' => ['required', 'string', 'max:255'],
            'area_of_study' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }
}
