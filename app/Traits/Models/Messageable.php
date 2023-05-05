<?php

namespace App\Traits\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Messageable
{
    public function sent_messages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function received_messages(): MorphToMany
    {
        return $this->morphToMany(Message::class, 'member', 'message_member')->withTimestamps();
    }
}
