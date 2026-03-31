<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
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
            'driverID' => $this->id,
            'userID' => $this->user_id,
            'isOnline' => boolval($this->is_online),
            'lastSeenOnline' => $this->went_offline_at,
            'totalTimeOnlineInMins' => $this->total_online_duration,
            'totalDistance' => $this->total_distance,
            'numOfCompletedRides' => $this->completed_rides,
            'driversLicenceNumber' => $this->drivers_licence_number,
            'driversLicenceFront' => $this->drivers_licence_front ? $this->drivers_licence_front : null,
            'driversLicenceBack' => $this->drivers_licence_back ? $this->drivers_licence_back : null,
            'vehicle' => new VehicleResource($this->vehicle),
            'avgRating'=>$this->reviews->avg('rating'),
            'reviews' => DriverReviewResource::collection($this->reviews)
        ];
    }
}
