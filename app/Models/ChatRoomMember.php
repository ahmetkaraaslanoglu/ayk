<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoomMember extends Model
{
    use HasFactory;

    protected $table = 'chat_room_members';

    protected $fillable = [
        'chat_room_id',
        'user_id',
    ];
}
