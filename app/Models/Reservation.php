<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'consulter_id',
        'user_id',
        'date',
        'time',
        'status',
    ];
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function consulter() : BelongsTo
    {
        return $this->belongsTo(Consulter::class);
    }
}
