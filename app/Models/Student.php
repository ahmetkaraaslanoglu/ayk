<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;

class Student extends Model implements Authenticatable
{
    use HasFactory;
    use Notifiable;
    use \Illuminate\Auth\Authenticatable;

    protected $fillable = [
        'school_class_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

//    protected $appends = [
//        'profile_photo_url',
//    ];

    public function school(): BelongsToMany
    {
        return $this->belongsToMany(School::class,'school_classes');
    }

//    public function teachers(): BelongsToMany
//    {
//        return $this->belongsToMany(Teacher::class,'teacher_school_classes');
//
//    }

    public function school_class(): HasOne
    {
        return $this->hasOne(SchoolClass::class, 'id', 'school_class_id');

    }

    public function homeworks(): BelongsToMany
    {
        return $this->belongsToMany(Homework::class, 'school_class_homework', 'school_class_id', 'homework_id');
    }

    public function absenteeisms(): HasMany
    {
        return $this->hasMany(Absenteeism::class);
    }

    public function exams() :BelongsToMany
    {
        return $this->belongsToMany(Exam::class,'student_school_class_exams','school_class_id','exam_id');
    }

    public function teachers():BelongsToMany
    {
        return $this->belongsToMany(Teacher::class,'student_school_class_teachers','school_class_id','teacher_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }



}




