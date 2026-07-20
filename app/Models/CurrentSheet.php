<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentSheet extends Model
{
    protected $fillable = ['user_id', 'sheet_id', 'values', 'expiration'];

    protected $casts = [
        'values'     => 'array',
        'expiration' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function presentationSheet()
    {
        return $this->belongsTo(PresentationSheet::class, 'sheet_id');
    }

    /**
     * Remplace les {{clés}} du template par les vraies valeurs
     */
    public function renderBody(): string
    {
        $body = $this->presentationSheet->body;
        foreach ($this->values ?? [] as $key => $value) {
            $body = str_replace('{{' . $key . '}}', e($value), $body);
        }
        return $body;
    }
}
