<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HairColor extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
