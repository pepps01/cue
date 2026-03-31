<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantEducationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->end_date == NULL) {
            $end_date = "Still Attend here";
        } else {
            $end_date = $this->end_date;
        }
        return [
            'schoolID' => $this->id,
            'schoolName' => $this->school_name,
            'startDate' => $this->start_date,
            'endDate' => $end_date,
            'degree' => $this->degree,
            'areaOfStudy' => $this->area_of_study,
            'description' => $this->description,
        ];
    }
}
