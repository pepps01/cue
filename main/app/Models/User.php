<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Uuids;

    protected $guarded = ['id'];

    protected $dates = [
        'deleted_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'full_name',
        'is_email_verified',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'device_token' => 'array',
        'device_id' => 'array'
    ];

    public function getIsEmailVerifiedAttribute()
    {

        if (!empty($this->email_verified_at)) {
            return 'verified';
        }
        return 'unverified';
    }

    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function bank()
    {
        return $this->hasOne(BankInformation::class, 'user_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id');
    }

    public function notification()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class, 'lga_id');
    }

    public function profile()
    {
        $role = $this->role;
        if ($role == 'consumer') {
            return $this->hasOne(Consumer::class, 'user_id');
        }
        if ($role == 'merchant') {
            return $this->hasOne(Merchant::class, 'user_id');
        }
        if ($role == 'driver') {
            return $this->hasOne(Driver::class, 'user_id');
        }
        if ($role == 'rider') {
            return $this->hasOne(Rider::class, 'user_id');
        }
        if ($role == 'vendor') {
            return $this->hasOne(CueChowVendor::class, 'user_id');
        }
        $adminRoles =  $adminRoles = ['admin', 'superadmin'];
        if (in_array($role, $adminRoles)) {
            return $this->hasOne(Admin::class, 'user_id');
        }
    }

    public function cards()
    {
        return $this->hasMany(BankCardInfo::class, 'user_id');
    }

    public function devices()
    {
        return $this->hasMany(UserDeviceToken::class, 'user_id');
    }

    public function communityChats()
    {
        return $this->hasMany(CommunityChat::class, 'user_id');
    }

    public function chatComments()
    {
        return $this->hasMany(CommunityChatComment::class, 'user_id');
    }
}
