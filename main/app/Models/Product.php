<?php

namespace App\Models;

use App\Traits\Uuids;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, Filterable, Uuids;
    protected $guarded = ['id'];

    public function merchant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function features()
    {
        return $this->hasMany(ProductFeature::class, 'product_id');
    }

    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    protected $appends = [
        'slug'
    ];

    public function getSlugAttribute()
    {
        $slug = Str::slug($this->name);
        return $slug;
    }
}
