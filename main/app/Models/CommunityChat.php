<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityChat extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reactions()
    {
        return $this->hasMany(CommunityChatReaction::class, 'post_id');
    }

    public function allcomments()
    {
        return $this->hasMany(CommunityChatComment::class, 'post_id');
    }
}
