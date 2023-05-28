<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChatRoom extends Model
{
    use HasFactory;

    protected $table = 'chat_rooms';

    protected $fillable = [
        'team_id',
        'message_header',
    ];

    public function team(): HasOne
    {
        return $this->hasOne(
            Team::class,
            'id',
            'team_id',
        );
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatRoomMessage::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'chat_room_members',

        );
    }
}
