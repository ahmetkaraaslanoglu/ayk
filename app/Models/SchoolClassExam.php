<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SchoolClassExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_class_id',
        'exam_id',
    ];

    public function school_class() : HasOne
    {
        return $this->hasOne(SchoolClass::class);
    }

    public function exam() : HasOne
    {
        return $this->hasOne(Exam::class);
    }
}
