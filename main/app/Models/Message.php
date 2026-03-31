<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function chat()
    {
        return $this->belongsTo(MessageChat::class, 'chat_id');
    }
}
