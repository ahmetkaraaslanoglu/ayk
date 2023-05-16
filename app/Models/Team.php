<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                User::class,
                'team_members',
                'team_id',
                'user_id',
            )
            ->withPivot([
                'role',
            ]);
    }
}
