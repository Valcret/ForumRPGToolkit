<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{
    protected $fillable = ['name', 'alt', 'avatar', 'forum_id', 'user_id','archived'];

    public function forum(): BelongsTo
    {
        return $this->belongsTo(Forum::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function roleplays(): BelongsToMany
    {
        return $this->belongsToMany(Roleplay::class, 'roleplay_characters')
            ->withPivot('turn');
    }

}
