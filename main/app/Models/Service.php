<?php

namespace App\Models;

use App\Traits\Uuids;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory, Uuids, Filterable;
    protected $guarded = ['id'];

    public function merchant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ServiceImage::class, 'service_id');
    }

    public function reviews()
    {
        return $this->hasMany(ServiceReview::class, 'service_id');
    }

    public function service_state()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function service_lga()
    {
        return $this->belongsTo(Lga::class, 'lga');
    }

    protected $appends = [
        'slug'
    ];

    public function getSlugAttribute()
    {
        $slug = Str::slug($this->service_name);
        return $slug;
    }
}
