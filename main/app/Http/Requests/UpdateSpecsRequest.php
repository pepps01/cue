<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpecsRequest extends FormRequest
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
            'spec' => ['array'],
            'spec.*' => ['array', 'required'],
            'spec.*.title' => ['string', 'required'],
            'spec.*.value' => ['string', 'required'],
        ];
    }
}
