<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetTripEarningsRequest extends FormRequest
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
            'dateRange' => [
                'nullable',
                'regex:/^\d{4}\/\d{2}\/\d{2}\s*-\s*\d{4}\/\d{2}\/\d{2}$/',
                function ($attribute, $value, $fail) {
                    [$start_date, $end_date] = explode('-', $value);
                    if (!(strtotime($start_date) && strtotime($end_date))) {
                        $fail('Invalid date format');
                    }
                    if (strtotime($start_date) >= strtotime($end_date)) {
                        $fail('The start date must be before the end date');
                    }
                },
            ],
        ];
    }
}
