<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Teacher extends Model implements Authenticatable
{
    use HasFactory;
    use HasFactory;
    use Notifiable;
    use \Illuminate\Auth\Authenticatable;

    protected $fillable = [
        'school_class_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

//    protected $appends = [
//        'profile_photo_url',
//    ];

    public function school() : HasOne
    {
        return $this->hasOne(School::class);
    }

    public function school_classes(): BelongsToMany
    {
        return $this->belongsToMany(SchoolClass::class,'teacher_school_classes');
    }

    public function students(): \Illuminate\Database\Eloquent\Builder
    {
        $ids = $this->school_classes()->get(['id'])->pluck('id');
        return Student::query()->whereIn('id',$ids);
    }
}
