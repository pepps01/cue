<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantCategoryResource extends JsonResource
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
            'categoryName' => $this->name,
            'merchantsCount' => count($this->merchants),
            'isActive' => boolval($this->is_active)
        ];
    }
}
