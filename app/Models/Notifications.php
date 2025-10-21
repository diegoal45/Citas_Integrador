<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = [
        
        'id_user',
        'type',
        'title',
        'message',
        'notes'
    ];
}
