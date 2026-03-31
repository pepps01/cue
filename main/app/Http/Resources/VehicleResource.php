<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'vehicleID' => $this->id,
            'driverID' => $this->driver_id,
            'manufacturer' => $this->manufacturer,
            'model' => $this->model,
            'year' => $this->year,
            'status' => $this->status,
            'color' => $this->color,
            'plate_number' => $this->plate_number,
            'car_interior_photo' => $this->car_interior_photo ? $this->car_interior_photo : null,
            'car_exterior_photo' => $this->car_exterior_photo ? $this->car_exterior_photo : null,
            'plate_number_on_car_photo' => $this->plate_number_on_car_photo ? $this->plate_number_on_car_photo : null
        ];
    }
}
