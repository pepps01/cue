<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Resources\Json\JsonResource;

class SosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->trip != null) {
            $driver = User::find($this->trip->driver->user_id)->only('firstname', 'lastname', 'email', 'phone', 'image', 'full_name');
            $rider = User::find($this->trip->rider->user_id)->only('firstname', 'lastname', 'email', 'phone', 'image', 'full_name');
            $driver['image'] != null ? $driver['image'] =$driver['image'] : null;
            $rider['image'] != null ? $rider['image'] = $rider['image'] : null;

            $driver_vehicle = Vehicle::where('driver_id', $this->trip->driver_id)->first();
            if ($driver_vehicle != null) {
                $driver_vehicle = $driver_vehicle->only('manufacturer', 'model', 'year', 'color', 'plate_number', 'car_exterior_photo');
                $driver['vehicle'] = $driver_vehicle;
                $driver['vehicle']['car_exterior_photo'] = $driver['vehicle']['car_exterior_photo'];
            } else {
                $driver['vehicle'] = null;
            }
        } else {
            $driver = NULL;
            $rider = NULL;
        }
        if ($this->initiated_by != null) {
            $result2 = new UserResource($this->initiated);
            $result2 = $result2->only(['id', 'fullName', 'email', 'phone', 'image', 'profile']);
            $result2['image'] != null ? $result2['image'] = $result2['image'] : null;
        } else {
            $result2 = NULL;
        }
        return [
            'sosID' => $this->id,
            'sosLocation' => $this->sos_location,
            'emergencyType' => $this->emergencyType,
            'initiatedBy' => $result2,
            'status' => $this->status,
            'createdAt' => $this->created_at,
            'driver' => $driver,
            'rider' => $rider,
            'sosAcceptedBy' => SosReactionResource::collection($this->accepted),
        ];
    }
}
