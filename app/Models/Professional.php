<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $fillable = [

        'id_user',
        'id_salon',
        'specialty',
        'description',
        'avatar',
        'active',
    ];
}
