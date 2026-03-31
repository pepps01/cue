<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityChatReaction extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsTo(CommunityChat::class, 'post_id');
    }
}
