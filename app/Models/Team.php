<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'description',
        'image_path',
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

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'team_id', 'id');
    }

}
