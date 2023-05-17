<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChatRoomMessage extends Model
{
    use HasFactory;

    protected $table = 'chat_room_messages';

    protected $fillable = [
        'chat_room_id',
        'user_id',
        'message',
    ];

    public function chat_room(): HasOne
    {
        return $this->hasOne(ChatRoom::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(
            User::class,
            'id',
            'user_id',
        );
    }
}
