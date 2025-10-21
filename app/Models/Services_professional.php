<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services_professional extends Model
{
    protected $fillable = [
        
        'id_service',
        'id_professional',
        'custom_price'
    ];
}
