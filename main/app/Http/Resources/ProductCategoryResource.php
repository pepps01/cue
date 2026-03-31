<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
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
            'categoryID' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'productsCount' => count($this->products),
            'image' => $this->image,
            'isActive' => boolval($this->is_active),
        ];
    }
}
