<?php

namespace App\Http\Resources;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $driver = ($this->driver_id && $this->driver) ? new UserResource(User::find($this->driver->user_id)) : null;
        $rider = ($this->rider_id && $this->rider) ? new UserResource(User::find($this->rider->user_id)) : null;
        return [
            'tripID' => $this->id,
            'tripDate' => $this->created_at,
            'basePrice' => $this->base_price,
            'totalPrice' => $this->total_price,
            'tripDuration' => $this->trip_duration,
            'driverArrivalTime' => $this->driver_arrival_time,
            'startTime' => $this->start_time,
            'startTripLocation' => $this->start_trip_location,
            'endTime' => $this->end_time,
            'durationSpentInMinutes' => $this->total_duration_spent,
            'distanceToPickup' => $this->distance_to_pickup,
            'requestLocation' => $this->request_location,
            'requestDateTime' => $this->request_date_time,
            'requestAcceptanceTime' => $this->request_acceptance_time,
            'pickupLocation' => $this->pickup_location,
            'dropoffLocation' => $this->dropoff_location,
            'distanceCovered' => $this->total_distance_covered,
            'cancelLocation' => $this->cancel_location,
            'cancelDateTime' => $this->cancel_date_time,
            'status' => $this->status,
            'isPaymentCompleted' => boolval($this->is_paid),
            'driver' => $driver,
            'rider' => $rider
        ];
    }
}
