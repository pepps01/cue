<?php

namespace App\Http\Resources;

use App\Models\GeneralSetting;
use Illuminate\Http\Resources\Json\JsonResource;

class TripLocationPricingResource extends JsonResource
{
    protected $status;
    public function __construct($resource, $status)
    {
        // Call the parent constructor
        parent::__construct($resource);

        // Store the $status value in the class property
        $this->status = $status;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        switch ($this->status) {
            case ("essential"):
                $base = $this->resource->base_fare * 1.7;
                $minimum = $this->resource->minimum_fare * 1.7;
                $distance = $this->resource->distance_rate_per_km * 1.7;
                $time = $this->resource->time_rate_per_min * 1.7;
                break;
            case ("luxury"):
                $base = $this->resource->base_fare * 2.5;
                $minimum = $this->resource->minimum_fare * 2.5;
                $distance = $this->resource->distance_rate_per_km * 2.5;
                $time = $this->resource->time_rate_per_min * 2.5;
                break;
            case ("economy"):
                $base = $this->resource->base_fare;
                $minimum = $this->resource->minimum_fare;
                $distance = $this->resource->distance_rate_per_km;
                $time = $this->resource->time_rate_per_min;
                break;
            default:
                $base = null;
                $minimum = null;
                $distance = null;
                $time = null;
        }
        $get_trip_price_variation = GeneralSetting::where('title', 'trip_price_variation')->value('value');
        $new_base = $base + ($base * $get_trip_price_variation ?? 0);
        $new_minimum = $minimum + ($minimum * $get_trip_price_variation ?? 0);
        $new_distance = $distance + ($distance * $get_trip_price_variation ?? 0);
        $new_time = $time + ($time * $get_trip_price_variation ?? 0);
        $total = $new_base + $new_minimum + $new_distance + $new_time;

        return [
            'status' => $this->status,
            'id' => $this->resource->id,
            'state' => $this->resource->state,
            'area' => $this->resource->areas,
            'baseFare' => $new_base,
            'minimumFare' => $new_minimum,
            'distanceRatePerKm' => $new_distance,
            'timeRatePerMin' => $new_time,
            'totalPrice' => $total,
            'createdAt' => $this->resource->created_at
        ];
    }
}
