<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->cac_document) {
            $cac_document = url('/storage/' . $this->cac_document);
        } else {
            $cac_document = NULL;
        }
        if ($this->identity_document) {
            $identity_document = url('/storage/' . $this->identity_document);
        } else {
            $identity_document = NULL;
        }

        if ($this->merchant_type == "business") {
            $info = [
                'cacNumber' => $this->cac_number,
                'cacDocument' => $this->cac_document,
                'identityType' => $this->identity_type,
                'identityDocument' => $this->identity_document,
            ];
        } elseif ($this->merchant_type == "personal") {
            $info = [
                'jobTitle' => $this->job_title,
                'yearsOfExperience' => $this->years_of_experience,
                'hoursPerWeek' => $this->hours_per_week,
                'chargesPerHour' => $this->charges_per_hour,
                'skills' => MerchantSkillSetResource::collection($this->skills),
                'workHistory' => MerchantWorkResource::collection($this->workHistory),
                'education' => MerchantEducationResource::collection($this->education),
                'languages' => MerchantLangaugeResource::collection($this->languages),
                'projects' => MerchantProjectResource::collection($this->projects)
            ];
        }

        return [
            'merchantID' => $this->id,
            'userID' => $this->user_id,
            'merchantType' => $this->merchant_type,
            'merchantCategory' => new MerchantCategoryResource($this->category),
            'bio' => $this->bio,
            'merchantInfo' => $info
        ];
    }
}
