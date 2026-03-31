<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceReviewResource extends JsonResource
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
            'reviewID' => $this->id,
            'serviceID' => $this->service_id,
            'merchantID' => $this->merchant_user_id,
            'userID' => $this->user_id,
            'reviewerName' => $this->reviewer,
            'rating' => $this->rating,
            'review' => $this->review,
            'datePosted' => $this->created_at,
        ];
    }
}
