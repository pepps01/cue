<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripEarningResource extends JsonResource
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
            'tripID' => $this->trip_id,
            'driverID' => $this->driver_id,
            'riderName' => $this->rider,
            'tripFare' => $this->trip_fare,
            'tripComm' => $this->trip_comm,
            'addedTip' => $this->added_tip,
            'status' => boolval($this->status),
            'date' => $this->created_at
        ];
    }
}
