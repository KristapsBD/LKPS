<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registration_number',
        'type',
        'status',
    ];

    /**
     * Define a relationship with the User model for the current driver of the vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function current_driver()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define a relationship with the User model for all drivers associated with this vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function drivers()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Define a relationship with the Parcel model for parcels associated with this vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }
}
