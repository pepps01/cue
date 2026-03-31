<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'cartID' => $this->id,
            'userID' => $this->user_id,
            'numberOfItems' => $this->number_of_items,
            'creationDate' => $this->created_at,
            'product' => new ProductResource($this->product),
        ];
    }
}
