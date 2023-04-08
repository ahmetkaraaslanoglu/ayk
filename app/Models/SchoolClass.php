<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'name',
    ];

    public function school()
    {
        return $this->hasOne(School::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'teacher_school_classes');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

//    public function homeworks(): BelongsToMany
//    {
//        return $this->belongsToMany(
//            Homework::class,
//            'school_class_homework',
//            'homework_id',
//            'school_class_id',
//        );
//    }

    public function homeworks(): BelongsToMany
    {
        return $this->belongsToMany(Homework::class, 'school_class_homework')
            ->withPivot('school_class_id')
            ->wherePivot('school_class_id', $this->id);
    }

    public function exams(): BelongsToMany
    {
        return $this->belongsToMany(
            Exam::class,
            'school_class_exams',
            'exam_id',
            'school_class_id',
        );
    }
}
