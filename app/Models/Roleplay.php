<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Roleplay extends Model
{
    protected $fillable = [
        'title',
        'url',
        'created_by',
        'prequel',
        'sequel',
        'forum_id',
        'started',
        'ended',
        'current_sum',
        'max_turn',
        'current_turn',
        'status_id',
        'archived_by',
        'last_post_at',
        'last_post_author',
        'last_synced_at',
    ];

    protected $casts = [
        'started'         => 'date',
        'ended'           => 'date',
        'last_post_at'    => 'datetime',
        'last_synced_at'  => 'datetime',
    ];

    // Auteur
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Préquelle (roleplay précédent)
    public function prequel(): BelongsTo
    {
        return $this->belongsTo(Roleplay::class, 'prequel');
    }

    // Sequel (roleplay suivant)
    public function sequel(): BelongsTo
    {
        return $this->belongsTo(Roleplay::class, 'sequel');
    }

    // Forum associé
    public function forum(): BelongsTo
    {
        return $this->belongsTo(Forum::class);
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(RoleplayStatus::class, 'status_id');
    }
    // App/Models/Roleplay.php
    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'roleplay_characters')
            ->withPivot('turn');  // ✅ indispensable
    }
    public function favoritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'roleplay_favorites')
            ->withPivot('priority_order')
            ->withTimestamps();
    }
    public function archivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'archived_by');
    }
}
