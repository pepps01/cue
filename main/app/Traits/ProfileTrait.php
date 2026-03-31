<?php

namespace App\Traits;

use App\Models\Admin;
use App\Models\BankInformation;
use App\Models\Consumer;
use App\Models\CueChowVendor;
use App\Models\Driver;
use App\Models\Merchant;
use App\Models\Rider;
use App\Models\User;
use App\Models\UserDeviceToken;
use App\Models\Wallet;
use Symfony\Component\HttpFoundation\Response;

trait ProfileTrait
{
    use VerificationTraits;
    public function create_profile($user, $data)
    {

        // What is the imput around this role?
        if ($user['role'] == "consumer") {
            Consumer::create(['user_id' => $user['id']]);
        }
        if ($user['role'] == "merchant") {
            Merchant::create([
                'user_id' => $user['id'],
                'merchant_type' => $data['merchant_type'],
                'category_id' => $data['category']
            ]);
        }
        if ($user['role'] == "driver") {
            Driver::create([
                'user_id' => $user['id'],
            ]);
        }
        if ($user['role'] == "rider") {
            Rider::create([
                'user_id' => $user['id'],
                'home_location' => $data['address']
            ]);
        }
        if ($user['role'] == "vendor") {
            CueChowVendor::create([
                'user_id' => $user['id'],
                'business_name' => $data['business_name'],
                'business_type' => $data['business_type'],
                'restaurant_type_id' => $data['restaurant_type_id'] ?? null,
                'no_of_stores' => $data['no_of_stores'],
                'business_location' => $data['address'],
                'business_phone' => $data['phone'],
                'business_email' => $data['email'],
            ]);
        }
        $adminRoles =  $adminRoles = ['admin', 'superadmin'];
        if (in_array($user['role'], $adminRoles)) {
            Admin::create(['user_id' => $user['id'], 'admin_type' => $data['role']]);
        }

        //send verification mail
        $this->sendVerificationCode($data['email'], 'verification', $data['firstname']);
    }

    public function storeUser($data)
    {
        $createUser = User::create($data);
        $createBankInfo = BankInformation::create(['user_id' => $createUser->id]);
        $createWallet = Wallet::create(['user_id' => $createUser->id]);

        return $createUser;
    }

    public function reward_ref_bonus($ref_by): void
    {
        $user = User::where('ref_code', $ref_by)->first();
        $user->wallet->update([
            'referral_bonus' => $user->wallet->referral_bonus + env('REF_BONUS')
        ]);
    }

    public function store_device_token($user, $data)
    {
        $existingToken = UserDeviceToken::where('user_id', $user->id)->first();

        if ($existingToken) {
            $existingToken->update(['device_token' => $data['device_token']]);
        } else {
            UserDeviceToken::create([
                'user_id' => $user->id,
                'device_token' => $data['device_token']
            ]);
        }
    }
}
