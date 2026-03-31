<?php

namespace App\ModelFilters;

use App\Traits\ApiResponse;
use EloquentFilter\ModelFilter;
use Symfony\Component\HttpFoundation\Response;

class ProductFilter extends ModelFilter
{
    use ApiResponse;
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
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->orWhere('brand', 'LIKE', "%{$search}%");
        });
    }

    public function category($category)
    {
        return $this->where('category_id', $category);
    }

    public function priceRange($value)
    {
        [$minPrice, $maxPrice] = explode('-', $value);
        return $this->where('price', '>=', $minPrice)
            ->where('price', '<=', $maxPrice);
    }

    public function discountPercentage($value)
    {
        [$minPrice, $maxPrice] = explode('-', $value);
        return $this->where('discount_percentage', '>=', $minPrice)
            ->where('discount_percentage', '<=', $maxPrice);
    }

    public function freeDelivery($params)
    {
        return $this->where('free_delivery', "LIKE", "%" . $params . "%");
    }

    public function byMerchant($merchant)
    {
        return $this->where('merchant_id', $merchant);
    }
}
