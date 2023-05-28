<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use App\Traits\Models\Messageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Znck\Eloquent\Relations\BelongsToThrough;

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
        'token',
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

    public function absences(): HasMany
    {
        if ($this->role === Role::Teacher){
            return $this->hasMany(Absence::class,'owner_id');
        }

        return $this->hasMany(Absence::class,'target_id');
    }

    public function studentHomeworks(): BelongsToMany
    {
        return $this->school_classes()
            ->join('school_class_homeworks', 'school_classes.id', '=', 'school_class_homeworks.school_class_id')
            ->join('homework', 'school_class_homeworks.homework_id', '=', 'homework.id')
            ->join('users', 'homework.user_id', '=', 'users.id')
            ->select('homework.*', 'users.name as user_name');
    }

    public function teacherHomeworks(): HasMany
    {
        return $this->hasMany(Homework::class, 'user_id');
    }


    public function teacherExams(): HasMany
    {
        return $this->hasMany(Exam::class,'user_id','id');
    }

    public function studentExams(): BelongsToMany
    {
        return $this->school_classes()
            ->join('school_class_exams', 'school_classes.id', '=', 'school_class_exams.school_class_id')
            ->join('exams', 'school_class_exams.exam_id', '=', 'exams.id')
            ->join('users', 'exams.user_id', '=', 'users.id')
            ->select('exams.*', 'users.name as user_name', 'users.profile_photo_url', 'users.email');
    }

//    public function exams(): HasMany | HasManyThrough
//    {
//        if ($this->role === Role::Teacher) {
//            return $this->hasMany(Exam::class,'user_id','id');
//        }
//
//        return $this->hasManyThrough(
//            Exam::class,
//            SchoolClass::class,
//            'id',
//            'school_id',
//        );
//    }

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

    public function teachers(): Collection
    {
        $teachers = collect();
        foreach (auth()->user()->school_classes as $school_class){
            $teachers = $teachers->merge($school_class->users()->where('user_school_classes.role','teacher')->get());
        }
        return $teachers;
    }

    public function students(array $with = []): Collection
    {
        $students = collect();
        foreach (auth()->user()->school_classes as $school_class) {
            $students = $students->merge($school_class->users()->where('user_school_classes.role','student')->with($with)->get());
        }
        return $students;
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(PostComment::class, 'user_id', 'id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

}
