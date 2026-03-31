<?php

namespace App\Rules;

use App\Models\ServiceCategory;
use Illuminate\Contracts\Validation\Rule;

class CheckActiveServiceCategory implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $serviceCategory = ServiceCategory::where('id', $value)->first();
        if (!$serviceCategory) {
            return "Service category not found";
        }
        if ($serviceCategory['is_active'] == 1) {
            return $serviceCategory['name'];
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected service category is no longer available';
    }
}
