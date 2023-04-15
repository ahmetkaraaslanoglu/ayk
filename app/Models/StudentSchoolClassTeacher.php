<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSchoolClassTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'school_class_id',
        'teacher_id',
    ];
}
