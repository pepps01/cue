<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RiderResource extends JsonResource
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
            'riderID' => $this->id,
            'userID' => $this->user_id,
            'homeLocation' => [
                'homeAddress' => $this->home_location,
                'homeLongitude' => $this->home_long,
                'homeLatitude' => $this->home_lat,
                'homePlaceID' => $this->home_place_id
            ],
            'workLocation' => [
                'workAddress' => $this->work_location,
                'workLongitude' => $this->work_long,
                'workLatitude' => $this->work_lat,
                'workPlaceID' => $this->work_place_id
            ],
            'favLocation' => RiderFavLocationResource::collection($this->favLocations),
            'completedRides' => $this->completed_rides,
            'reviews' => RiderReviewResource::collection($this->reviews)
        ];
    }
}
