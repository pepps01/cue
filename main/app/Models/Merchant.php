<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory, Uuids;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(MerchantCategory::class, 'category_id');
    }
    public function skills()
    {
        return $this->hasMany(MerchantSkillSet::class, 'merchant_id');
    }
    public function workHistory()
    {
        return $this->hasMany(MerchantWorkHistory::class, 'merchant_id');
    }
    public function education()
    {
        return $this->hasMany(MerchantEducationHistory::class, 'merchant_id');
    }
    public function languages()
    {
        return $this->hasMany(MerchantLanguage::class, 'merchant_id');
    }
    public function projects()
    {
        return $this->hasMany(MerchantProject::class, 'merchant_id');
    }
}
