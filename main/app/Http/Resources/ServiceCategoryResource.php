<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
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
            'servicesCount' => count($this->services),
            'image' => $this->image,
            'isActive' => boolval($this->is_active)
        ];
    }
}
