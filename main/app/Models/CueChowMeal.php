<?php

namespace App\Models;

use App\Traits\Uuids;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CueChowMeal extends Model
{
    use HasFactory, Uuids, Filterable;

    protected $guarded = ['id'];

    public function vendor()
    {
        return $this->belongsTo(CueChowVendor::class);
    }
}
