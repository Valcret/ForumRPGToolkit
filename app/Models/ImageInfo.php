<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageInfo extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'image_id',
        'eyes_color_id',
        'hair_color_id',
        'hair_length_id',
        'size_id',
        'history_id',
        'beard_id',
        'age_id',
        'image_size_id',
        'gender_id',
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function eyesColor(): BelongsTo
    {
        return $this->belongsTo(EyesColor::class);
    }

    public function hairColor(): BelongsTo
    {
        return $this->belongsTo(HairColor::class);
    }

    public function hairLength(): BelongsTo
    {
        return $this->belongsTo(HairLength::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function history(): BelongsTo
    {
        return $this->belongsTo(History::class);
    }

    public function beard(): BelongsTo
    {
        return $this->belongsTo(Beard::class);
    }

    public function age(): BelongsTo
    {
        return $this->belongsTo(Age::class);
    }

    public function imageSize(): BelongsTo
    {
        return $this->belongsTo(ImageSize::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }
}
