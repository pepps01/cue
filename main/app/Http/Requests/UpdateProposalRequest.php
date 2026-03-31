<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProposalRequest extends FormRequest
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
            'payment_option' => ['required', 'string', Rule::in(['by_milestone', 'by_project'])],
            'total_price' => ['required_if:payment_option,==,by_project', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'milestones' => ['required_if:payment_option,==,by_milestone', 'array'],
            'milestones.*' => ['array', 'required'],
            'milestones.*.description' => ['nullable', 'string'],
            'milestones.*.due_date' => ['nullable', 'date'],
            'milestones.*.amount' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'expected_duration' => ['nullable', 'string'],
            'cover_letter' => ['nullable', 'string']
        ];
    }
}
