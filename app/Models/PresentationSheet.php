<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresentationSheet extends Model
{
    protected $fillable = ['title', 'body', 'forum_id'];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function currentSheets()
    {
        return $this->hasMany(CurrentSheet::class, 'sheet_id');
    }

    /**
     * Extrait les clés dynamiques du template HTML
     * Ex: {{nom}} -> ['nom']
     */
    public function extractFields(): array
    {
        preg_match_all('/\{\{(\w+)\}\}/', $this->body, $matches);
        return array_unique($matches[1]);
    }
}
