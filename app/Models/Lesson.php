<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';

    protected $fillable = [
        'name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(
            User::class,
            'lesson_id',
            'id',
        );
    }
}
