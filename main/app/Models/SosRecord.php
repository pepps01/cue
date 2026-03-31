<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosRecord extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    public function initiated()
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

    public function accepted()
    {
        return $this->hasMany(SosReaction::class, 'sos_id');
    }

    public function reports()
    {
        return $this->hasMany(SosReports::class, 'sos_id');
    }
}
