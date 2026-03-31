<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
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
            'mealID' => $this->id,
            'userID' => $this->user_id,
            'name' => $this->name,
            'description' => $this->description,
            'images' => json_decode($this->image, true),
            'price' => $this->price,
            'price_desc' => $this->price_desc,
            'isPackRequired' => boolval($this->is_pack_required),
            'packPrice' => $this->pack_price,
            'isInStock' => boolval($this->is_in_stock),
            'vendor' => new VendorResource($this->vendor),
            'dateCreated' => $this->created_at
        ];
    }
}
