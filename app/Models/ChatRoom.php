<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChatRoom extends Model
{
    use HasFactory;

    protected $table = 'chat_rooms';

    protected $fillable = [
        'team_id',
        'name',
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
}
