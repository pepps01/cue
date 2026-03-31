<?php

namespace App\Rules;

use App\Models\MerchantCategory;
use Illuminate\Contracts\Validation\Rule;

class CheckActiveMerchantCategory implements Rule
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
        $merchantCategory = MerchantCategory::where('id', $value)->first();
        if (!$merchantCategory) {
            return "Merchant category not found";
        }
        if ($merchantCategory['is_active'] == 1) {
            return $merchantCategory['name'];
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected merchant category is no longer available';
    }
}
