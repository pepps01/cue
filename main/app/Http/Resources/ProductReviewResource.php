<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewResource extends JsonResource
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
            'productID' => $this->product_id,
            'userID' => $this->user_id,
            'reviewerName' => $this->reviewer,
            'rating' => $this->rating,
            'review' => $this->review,
            'datePosted' => $this->created_at,
        ];
    }
}
