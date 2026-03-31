<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJobPostRequest extends FormRequest
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
            'headline' => ['nullable', 'string', 'max:255'],
            'skills_needed' => ['nullable', 'json'],
            'experience_level' => ['nullable', 'string'],
            'job_duration' => ['nullable', 'string'],
            'job_scope' => ['nullable', 'string', Rule::in(['Large', 'Medium', 'Small'])],
            'budget' => ['nullable', 'string'],
            'is_budget_negotiable' => ['nullable', Rule::in(['0', '1'])],
            'description' => ['nullable', 'string'],
        ];
    }
}
