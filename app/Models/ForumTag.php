<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ForumTag extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function forums(): BelongsToMany
    {
        return $this->belongsToMany(Forum::class, 'forum_tag_list', 'forum_tag_id', 'forum_id');
    }
}
