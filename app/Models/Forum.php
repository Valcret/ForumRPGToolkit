<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Forum extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'alt', 'button', 'nsfw', 'type',
        'db_host', 'db_port', 'db_database', 'db_username', 'db_password', 'table_prefix',
    ];

    protected $casts = [
        'nsfw' => 'boolean',
        'db_password' => 'encrypted',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(ForumTag::class, 'forum_tag_list', 'forum_id', 'forum_tag_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_forum', 'forum_id', 'user_id')
            ->withPivot('admin');
    }
    public function presentationSheets(): HasMany
    {
        return $this->hasMany(PresentationSheet::class);
    }
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }
    public function presentationSheet()
    {
        return $this->hasOne(PresentationSheet::class);
    }

}
