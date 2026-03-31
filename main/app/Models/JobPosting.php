<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class JobPosting extends Model
{
    use HasFactory, Uuids;
    protected $guarded = ['id'];

    protected $casts = [
        'skills_needed' => 'array'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function proposals()
    {
        return $this->hasMany(JobProposal::class, 'job_id');
    }

    protected $appends = [
        'slug'
    ];

    public function getSlugAttribute()
    {
        $slug = Str::slug($this->headline);
        return $slug;
    }
}
