<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TripEarningFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function dateRange($params)
    {
        $explodeRange = explode('-', $params);
        return $this->whereBetween('created_at', [$explodeRange[0], $explodeRange[1]]);
    }
}
