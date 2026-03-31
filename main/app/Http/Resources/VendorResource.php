<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
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
            'vendorID' => $this->id,
            'userID' => $this->user_id,
            'businessName' => $this->business_name,
            'businessType' => $this->business_type,
            'restaurantType' => $this->restaurant_type_id ? new RestaurantResource($this->restaurantType) : null,
            'businessLocation' => $this->business_location,
            'businessEmail' => $this->business_email,
            'businessPhone' => $this->business_phone,
            'noOfStores' => $this->no_of_stores,
            'deliveryType' => $this->delivery_type,
            'openingDays' => json_decode($this->opening_days),
            'openingHours' => $this->opening_hours,
            'closingHours' => $this->closing_hours,
            'taxID' => $this->tax_id,
            'isVerified' => boolval($this->is_verified),
            'isOpened' => boolval($this->is_opened),
            'ratings' => $this->ratings,
        ];
    }
}
