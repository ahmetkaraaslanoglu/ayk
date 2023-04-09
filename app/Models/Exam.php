<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'deadline',
        'exam_link',
        'sender',
    ];

    public function school_classes():BelongsToMany
    {
        return $this->belongsToMany(
            SchoolClass::class,
            'school_class_exams',
            'school_class_id',
            'exam_id',
        );
    }
}
