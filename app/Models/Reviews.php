<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = [
        
        'id_cita',
        'id_cliente',
        'id_professional',
        'id_service',
        'qualification',
        'comment',
        'professional_response',
    ];
}
