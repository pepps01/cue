<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalResource extends JsonResource
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
            'withdrawID' => $this->id,
            'userID' => $this->user_id,
            'fullname' => $this->fullname,
            'amount' => $this->amount,
            'applicationName' => $this->application_name,
            'status' => $this->status,
            'rejectionReason' => $this->rejection_reason,
            'requestDate' => $this->created_at
        ];
    }
}
