<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClassLesson extends Model
{
    use HasFactory;

    protected $table = 'school_class_lessons';

    protected $fillable = [
        'school_class_id',
        'lesson_id',
    ];
}
