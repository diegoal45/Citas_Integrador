<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dates extends Model
{
    protected $fillable = [

        'id_user',
        'id_professional',
        'id_service',
        'confirmation_code',
        'date',
        'start_time',
        'confirend_timemation_code',
        'active',
        'final_price',
        'notes',
    ];
}
