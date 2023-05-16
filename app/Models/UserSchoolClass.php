<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSchoolClass extends Model
{
    use HasFactory;

    protected $table = 'user_school_classes';

    protected $fillable = [
        'user_id',
        'school_class_id',
        'role',
    ];
}
