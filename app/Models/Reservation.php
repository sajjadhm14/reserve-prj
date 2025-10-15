<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'consulter_id',
        'user_id',
        'subject',
        'description',
    ];
}
