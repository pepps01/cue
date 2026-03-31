<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory, Uuids;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(RiderReview::class, 'rider_id');
    }

    public function favLocations()
    {
        return $this->hasMany(RiderFavLocation::class, 'rider_id');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'rider_id');
    }
}
