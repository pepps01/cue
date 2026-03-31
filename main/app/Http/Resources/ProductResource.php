<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'product' => [
                'productID' => $this->id,
                'userID' => $this->user_id,
                'serial' => $this->serial,
                'name' => $this->name,
                'slug' => $this->slug,
                'brand' => $this->brand,
                'price' => $this->price,
                'discount' => [
                    'isDiscountAvailable' => $this->discount_available,
                    'discountPercentage' => $this->discount_percentage,
                    'discountAmount' => $this->discount_amount
                ],
                'description' => $this->description,
                'quantity' => $this->quantity,
                'weight' => $this->weight,
                'productWarranty' => $this->product_warranty,
                'isActive' => boolval($this->is_active),
                'numberOfOrders' => $this->number_of_orders,
                'delivery' => [
                    'freeDelivery' => $this->free_delivery,
                    'shippingFee' => $this->shipping_fee
                ],
                'features' => ProductFeatureResource::collection($this->features),
                'specifications' => ProductSpecificationResource::collection($this->specifications),
                'images' => ProductImageResource::collection($this->images)
            ],
            'merchant' => new UserResource($this->merchant),
            'category' => new ProductCategoryResource($this->category),
            'reviews' => ProductReviewResource::collection($this->reviews),
            'averageRating' => $this->reviews->avg('rating'),
            'productCreationDate' => $this->created_at
        ];
    }
}
