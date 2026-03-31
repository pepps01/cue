<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'orderID' => $this->id,
            'userID' => $this->buyer_id,
            'price' => $this->price,
            'quantityPurchased' => $this->quantity,
            'deliveryCharge' => $this->delivery_charge,
            'deliveryCharge' => $this->delivery_charge,
            'orderDate' => $this->created_at,
            'expectedDeliveryDate' => $this->exp_delivery_date,
            'deliveryAddress' => $this->delivery_address,
            'state' => new StateResource($this->delivery_state),
            'lga' => new LgaResource($this->delivery_lga),
            'phone' => $this->phone,
            'paymentMethodUsed' => $this->payment_method,
            'paymentStatus' => $this->payment_status,
            'status' => $this->status,
            'buyer' => new UserResource($this->buyer),
            'product' => new ProductResource($this->product),
        ];
    }
}
