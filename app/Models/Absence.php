<?php

namespace App\Models;

use App\Enums\AbsenceReason;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Absence extends Model
{
    use HasFactory;

    protected $table = 'absences';

    protected $fillable = [
        'owner_id',
        'target_id',
        'reason',
        'date',
    ];

    protected $casts = [
        'reason' => AbsenceReason::class,
        'date' => 'datetime',
    ];

    public function owner(): HasOne
    {
        return $this->hasOne(User::class,'id','owner_id');
    }
}
