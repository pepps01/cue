<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'service' => [
                'serviceID' => $this->id,
                'userID' => $this->user_id,
                'serial' => $this->serial,
                'serviceName' => $this->service_name,
                'slug' => $this->slug,
                'yearsOfExperience' => $this->years_of_exp,
                'pricing' => $this->amount,
                'location' => $this->location,
                'state' => new StateResource($this->service_state),
                'lga' => new LgaResource($this->service_lga),
                'phoneNumber' => $this->phone_number,
                'other_details' => json_decode($this->other_details),
                'description' => $this->description,
                'isActive' => boolval($this->is_active),
                'images' => ServiceImageResource::collection($this->images)
            ],
            'merchant' => new UserResource($this->merchant),
            'category' => new ServiceCategoryResource($this->category),
            'reviews' => ServiceReviewResource::collection($this->reviews),
            'averageRating' => $this->reviews->avg('rating'),
            'datePosted' => $this->created_at
        ];
    }
}
