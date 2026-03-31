<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = url('/storage/' . $this->image);
        return [
            'imageID' => $this->id,
            'image' => $this->image,
            'isPrimary' => boolval($this->is_primary)
        ];
    }
}
