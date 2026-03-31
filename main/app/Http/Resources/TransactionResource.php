<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'transID' => $this->id,
            'serial' => $this->serial,
            'userID' => $this->user_id,
            'fullname' => $this->fullname,
            'applicationName' => $this->application_name,
            'amount' => $this->amount,
            'paymentMethod' => $this->payment_method,
            'purpose' => $this->purpose,
            'paymentReference' => $this->payment_reference,
            'status' => $this->status,
            'transDate' => $this->created_at
        ];
    }
}
