<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoomMessage extends Model
{
    use HasFactory;

    protected $table = 'chat_room_messages';

    protected $fillable = [
        'chat_room_id',
        'user_id',
        'message',
    ];
}
