<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable; // <<< THIS IS THE CORRECT TRAIT TO USE
use Illuminate\Notifications\Notifiable; // Recommended for auth models


class consulter extends Model implements AuthenticatableContract
{
    // Use the Authenticatable trait to implement all required methods
    use Authenticatable, Notifiable;

    protected $fillable = [
        'name',
        'password',
        'email',
        'specialization',
        'reservation_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * These are automatically required by the Authenticatable trait.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function reservation() : HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
