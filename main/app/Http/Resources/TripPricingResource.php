<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripPricingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'base_fare' => $this->base_fare,
            'minimum_fare' => $this->minimum_fare,
            'distance_rate_per_km' => $this->distance_rate_per_km,
            'time_rate_per_min' => $this->time_rate_per_min
        ];
    }
}
