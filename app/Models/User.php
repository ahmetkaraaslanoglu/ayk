<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use App\Traits\Models\Messageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , Messageable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lesson_id',
        'school_id',
        'role',
        'name',
        'email',
        'password',
        'profile_photo_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => Role::class,
    ];

    public function lesson(): HasOne
    {
        return $this->hasOne(
            Lesson::class,
            'id',
            'lesson_id',
        );
    }

    public function homeworks(): HasMany | BelongsToMany
    {
        if ($this->role === Role::Teacher) {
            return $this->hasMany(Homework::class);
        }

        return $this->belongsToMany(
            Homework::class,
            'school_class_homeworks',
            'user_id',
            'homework_id',
        );
    }

    public function exams(): HasMany | BelongsToMany
    {
        if ($this->role === Role::Teacher) {
            return $this->hasMany(Exam::class);
        }

        return $this->belongsToMany(
            Exam::class,
            'school_class_exams',
            'user_id',
            'exam_id',
        );
    }

    public function school_classes(): BelongsToMany
    {
        return $this->belongsToMany(
            SchoolClass::class,
            'user_school_classes',
            'user_id',
            'school_class_id',
        )->withPivot(['role']);
    }

    public function chat_rooms(): BelongsToMany
    {
        return $this->belongsToMany(
            ChatRoom::class,
            'chat_room_members',
            'user_id',
            'chat_room_id',
        );
    }
}
