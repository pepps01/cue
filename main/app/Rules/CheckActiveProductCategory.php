<?php

namespace App\Rules;

use App\Models\ProductCategory;
use Illuminate\Contracts\Validation\Rule;

class CheckActiveProductCategory implements Rule
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
        $productCategory = ProductCategory::where('id', $value)->first();
        if (!$productCategory) {
            return "Product category not found";
        }
        if ($productCategory['is_active'] == 1) {
            return $productCategory['name'];
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected product category is no longer available';
    }
}
