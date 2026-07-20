<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OtherCriteria extends Model
{
    public $timestamps = false;
    protected $table = 'other_criterias';
    protected $fillable = ['name'];
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'other_images');
    }

}
