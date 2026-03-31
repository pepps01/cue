<?php

namespace App\Models;

use App\Traits\Uuids;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripEarning extends Model
{
    use HasFactory, Uuids, Filterable;

    protected $guarded = ['id'];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }
}
