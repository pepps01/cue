<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantWorkResource extends JsonResource
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
            $end_date = "Currently Work Here";
        } else {
            $end_date = $this->end_date;
        }
        return [
            'workID' => $this->id,
            'workTitle' => $this->job_title,
            'companyName' => $this->company_name,
            'companyName' => $this->company_name,
            'startDate' => $this->start_date,
            'endDate' => $end_date,
            'jobDescription' => $this->job_description,
        ];
    }
}
