<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServiceCategory extends Model
{
    use HasFactory, Uuids;
    protected $guarded = ['id'];

    public function getSlugAttribute()
    {
        $slug = Str::slug($this->name);
        return $slug;
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}
