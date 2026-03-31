<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class CueChowMealFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function search($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('name', 'LIKE', "%{$value}%")
                ->orWhere('description', 'LIKE', "%{$value}%");
        });
    }

    public function inStock($value)
    {
        if ($value === 'true') {
            return $this->where('is_in_stock', true);
        } elseif ($value === 'false') {
            return $this->where('is_in_stock', false);
        }
    }

    public function vendor($vendor)
    {
        return $this->where('vendor_id', $vendor);
    }

    public function priceRange($value)
    {
        [$minPrice, $maxPrice] = explode('-', $value);
        return $this->where('price', '>=', $minPrice)
            ->where('price', '<=', $maxPrice);
    }
}
