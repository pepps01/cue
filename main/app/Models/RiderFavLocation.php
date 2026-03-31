<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiderFavLocation extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function rider()
    {
        return $this->belongsTo(Rider::class, 'rider_id');
    }
}
