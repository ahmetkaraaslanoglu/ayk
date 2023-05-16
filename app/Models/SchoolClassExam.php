<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SchoolClassExam extends Model
{
    use HasFactory;

    protected $table = 'school_class_exams';

    protected $fillable = [
        'school_class_id',
        'exam_id',
    ];
}
