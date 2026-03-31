<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->amountPaid == NULL) {
            $amountPaid = "Not Paid";
        } else {
            $amountPaid = $this->amountPaid;
        }
        return [
            'requestID' => $this->id,
            'consumerID' => $this->consumer_user_id,
            'requestStatus' => $this->status,
            'paymentStatus' => $this->payment_status,
            'amountPaid' => $amountPaid,
            'service' => new ServiceResource($this->service),
            'requestDate' => $this->created_at
        ];
    }
}
