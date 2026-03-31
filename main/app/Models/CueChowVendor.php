<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CueChowVendor extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurantType()
    {
        return $this->belongsTo(RestaurantType::class);
    }

    public function meals()
    {
        return $this->hasMany(CueChowMeal::class, 'vendor_id');
    }
}
