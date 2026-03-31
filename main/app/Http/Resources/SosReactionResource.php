<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SosReactionResource extends JsonResource
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
            "id"=> $this->id,
            "sos_id"=> $this->sos_id,
            "distressed_user"=> $this->distressed_user,
            "accepted_by"=> $this->accepted_by,
            "accept_location"=> $this->accept_location,
            "accepted_at"=> $this->accepted_at,
        ];
    }
}
