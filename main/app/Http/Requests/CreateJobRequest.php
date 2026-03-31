<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateJobRequest extends FormRequest
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
            'headline' => ['required', 'string', 'max:255'],
            'skills_needed' => ['required', 'json'],
            'experience_level' => ['nullable', 'string'],
            'job_duration' => ['required', 'string'],
            'job_scope' => ['required', 'string', Rule::in(['Large', 'Medium', 'Small'])],
            'budget' => ['required', 'string'],
            'is_budget_negotiable' => ['required', Rule::in(['0', '1'])],
            'description' => ['nullable', 'string'],
        ];
    }
}
