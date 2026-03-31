<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $role = $this->role;
        if ($role == 'consumer') {
            $profile = new ConsumerResource($this->profile);
        }
        if ($role == 'merchant') {
            $profile = new MerchantResource($this->profile);
        }
        if ($role == 'driver') {
            $profile = new DriverResource($this->profile);
        }
        if ($role == 'rider') {
            $profile = new RiderResource($this->profile);
        }
        if ($role == 'vendor') {
            $profile = new VendorResource($this->profile);
        }
        $adminRoles =  $adminRoles = ['admin', 'superadmin'];
        if (in_array($role, $adminRoles)) {
            $profile = new AdminResource($this->profile);
        }

        if ($this->image) {
            $image = url('/storage/' . $this->image);
        } else {
            $image = NULL;
        }

        return [
            'userID' => $this->id,
            'email' => $this->email,
            'firstName' => $this->firstname,
            'lastName' => $this->lastname,
            'fullName' => $this->full_name,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
            'state' => new StateResource($this->state),
            'lga' => new LgaResource($this->lga),
            'emailVerifiedStatus' => $this->is_email_verified,
            'role' => $this->role,
            'referredBy' => $this->ref_by,
            'myRefCode' => $this->ref_code,
            'dateOfBirth' => $this->date_of_birth,
            'isActive' => boolval($this->is_active),
            'isNotify' => boolval($this->is_notify),
            'dateJoined' => $this->created_at,
            'applicationName' => $this->application_name,
            'image' => $this->image,
            'bank' => new BankResource($this->bank),
            'cards' => BankCardResource::collection($this->cards),
            'profile' => $profile,
            'wallet' => new WalletResource($this->wallet),
            'dateAdded' => $this->created_at
        ];
    }
}
