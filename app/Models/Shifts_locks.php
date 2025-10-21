<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shifts_locks extends Model
{
    protected $fillable = [
        
        'id_professional',
        'date',
        'start_time',
        'end_time',
        'reason'
    ];
}
