<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street',
        'city',
        'postal_code',
    ];

    /**
     * Define a relationship with the User model for senders.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sender()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Define a relationship with the Client model for receivers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receiver()
    {
        return $this->hasMany(Client::class);
    }
}
