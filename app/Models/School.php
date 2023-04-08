<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public function school_classes(): HasMany
    {
        return $this->hasMany(SchoolClass::class,'school_id','id');
    }

    public function students(): HasManyThrough
    {
        return $this->hasManyThrough(Student::class,SchoolClass::class);

    }

    public function teachers(): HasManyThrough
    {
        return $this->hasManyThrough(Teacher::class,SchoolClass::class);
    }
}
