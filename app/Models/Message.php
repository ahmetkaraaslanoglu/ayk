<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'content',
    ];


//    public function users(): \Illuminate\Database\Eloquent\Relations\MorphToMany
//    {
//        return $this->morphedByMany(User::class, 'user', 'message_user')->withTimestamps();
//    }
//
//    public function teachers(): \Illuminate\Database\Eloquent\Relations\MorphToMany
//    {
//        return $this->morphedByMany(Teacher::class, 'user', 'message_user')->withTimestamps();
//    }
//
//    public function students(): \Illuminate\Database\Eloquent\Relations\MorphToMany
//    {
//        return $this->morphedByMany(Student::class, 'user', 'message_user')->withTimestamps();
//    }
}
