<?php

namespace App\Models;

use App\Enums\AbsenceReason;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
