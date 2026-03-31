<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function rider()
    {
        return $this->belongsTo(Rider::class, 'rider_id');
    }
}
