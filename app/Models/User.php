<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Forum;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }
    public function forums(): BelongsToMany
    {
        return $this->belongsToMany(Forum::class, 'user_forum', 'user_id', 'forum_id')
            ->withPivot('admin');
    }
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }
    public function currentSheets(): HasMany
    {
        return $this->hasMany(CurrentSheet::class);
    }
    public function favoriteRoleplays(): BelongsToMany
    {
        return $this->belongsToMany(Roleplay::class, 'roleplay_favorites')
            ->withPivot('priority_order')
            ->withTimestamps()
            ->orderByPivot('priority_order', 'asc');
    }

}
