<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AllBankResource extends JsonResource
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
            'bankID' => $this->id,
            'bankName' => $this->bank_name,
            'abbreviation' => $this->abbreviation,
            'paystackCode' => $this->paystack_code,
        ];
    }
}
