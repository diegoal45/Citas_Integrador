<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = [

        'id_date',
        'amount',
        'payment_method',
        'estado_pago',
        'notes'
    ];
}
