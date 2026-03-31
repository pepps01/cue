<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobProposalMilestoneResource extends JsonResource
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
            'description' => $this->description,
            'dueDate' => $this->due_date,
            'amount' => $this->amount,
            'paymentStatus' => $this->payment_status,
            'status' => $this->status,
            'createdDate' => $this->created_at
        ];
    }
}
