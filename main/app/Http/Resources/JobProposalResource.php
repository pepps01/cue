<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobProposalResource extends JsonResource
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
            'proposalID' => $this->id,
            'job' => new JobPostResource($this->job),
            'employerID' => $this->consumer_id,
            'merchantID' => $this->merchant_id,
            'paymentOption' => $this->payment_option,
            'total_price' => $this->total_price,
            'numOfMilestones' => $this->num_of_milestones,
            'milestones' => JobProposalMilestoneResource::collection($this->milestones),
            'amountToReceive' => $this->expected_amount,
            'expectedDuration' => $this->expected_duration,
            'coverLetter' => $this->cover_letter,
            'reviewComment' => $this->review_comment,
            'rejectionReason' => $this->rejection_reason,
            'paymentStatus' => $this->payment_status,
            'status' => $this->status,
            'submissionDate' => $this->created_at
        ];
    }
}
