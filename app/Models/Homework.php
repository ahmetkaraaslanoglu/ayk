<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Homework extends Model
{
    use HasFactory;

    protected $table = 'homework';

    protected $fillable = [
        'content',
        'deadline',
        'subject',
        'photo',
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

}
