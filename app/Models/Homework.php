<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Homework extends Model
{
    use HasFactory;

    protected $table = 'homework';

    protected $fillable = [
        'owner_id',
        'content',
        'deadline',
        'lesson',
        'subject',
        'photo',
        'is_done',
    ];

    public function school_classes():BelongsToMany
    {
        return $this->belongsToMany(
            SchoolClass::class,
            'school_class_homework',
            'school_class_id',
            'homework_id',
        );
    }

    public function owner():HasOne
    {
        return $this->hasOne(Teacher::class,'id','owner_id');
    }

}
