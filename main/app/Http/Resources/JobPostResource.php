<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->attachment) {
            $attachment = url('/storage/' . $this->attachment);
        } else {
            $attachment = NULL;
        }
        return [
            'jobID' => $this->id,
            'userID' => $this->user_id,
            'headline' => $this->headline,
            'slug' => $this->slug,
            'skillsNeeded' => json_decode($this->skills_needed),
            'experienceLevel' => $this->experience_level,
            'jobDuration' => $this->job_duration,
            'jobScope' => $this->job_scope,
            'budget' => $this->budget,
            'isBudgetNegotiable' => boolval($this->is_budget_negotiable),
            'description' => $this->description,
            'isActive' => boolval($this->is_active),
            'datePosted' => $this->created_at
        ];
    }
}
