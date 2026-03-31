<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
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
            'escrowBalance' => $this->escrow_amount,
            'withdrawableBalance' => $this->withdrawable_amount,
            'referralBonus' => $this->referral_bonus,
            'points' => $this->points,
            'lastUpdate' => $this->updated_at
        ];
    }
}
