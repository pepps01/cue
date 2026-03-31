<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityChatComment extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsTo(CommunityChat::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
