<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    protected $fillable = [
        
        'id_professional',
        'day_week',
        'start_time',
        'end_time',
        'effective_start_date',
        'effective_end_date',
        'active',
    ];
}
