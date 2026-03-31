<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RiderFavLocationResource extends JsonResource
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
            'id' => $this->id,
            'riderID' => $this->rider_id,
            'favName' => $this->fav_name,
            'favAddress' => $this->fav_location,
            'favLongitude' => $this->fav_long,
            'favLatitude' => $this->fav_lat,
            'favPlaceID' => $this->fav_place_id,
            'dateAddedd' => $this->created_at
        ];
    }
}
