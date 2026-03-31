<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ServiceFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function search($search)
    {
        return $this->where(function ($query) use ($search) {
            $query->where('service_name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->orWhere('location', 'LIKE', "%{$search}%");
        });
    }

    public function category($category)
    {
        return $this->where('category_id', $category);
    }

    public function state($state)
    {
        return $this->where('state', $state);
    }

    public function lga($lga)
    {
        return $this->where('lga', $lga);
    }

    public function byMerchant($merchant)
    {
        return $this->where('merchant_id', $merchant);
    }
}
