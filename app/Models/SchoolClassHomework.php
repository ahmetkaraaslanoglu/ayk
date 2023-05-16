<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SchoolClassHomework extends Model
{
    use HasFactory;

    protected $table = 'school_class_homeworks';

    protected $fillable = [
        'school_class_id',
        'homework_id',
    ];
}
