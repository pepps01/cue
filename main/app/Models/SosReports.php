<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosReports extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function sos()
    {
        return $this->belongsTo(SosRecord::class, 'sos_id');
    }
}
