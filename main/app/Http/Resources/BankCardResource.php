<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BankCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $authorization = json_decode($this->authorization, true);
        unset($authorization['authorization_code']);
        unset($authorization['signature']);
        return [
            'cardID' => $this->id,
            'userID' => $this->user_id,
            'cardNumber' => $this->card_number,
            'expiryDate' => $this->expiry_date,
            'status' => boolval($this->status),
            'authorization' => $authorization,
            'dateCreated' => $this->created_at
        ];
    }
}
