<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Image extends Model
{
    protected $fillable = ['url', 'name'];

    public function info(): HasOne
    {
        return $this->hasOne(ImageInfo::class);
    }
    public function otherCriterias(): BelongsToMany
    {
        return $this->belongsToMany(OtherCriteria::class, 'other_images');
    }

}
