<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleplayStatus extends Model
{
    public $timestamps = false;

    protected $table = 'roleplay_status';

    protected $fillable = ['name'];
}
