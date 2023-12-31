<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Define a relationship with the Parcel model for parcels associated with this user as a sender.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parcels()
    {
        return $this->hasMany(Parcel::class, 'sender_id');
    }

    /**
     * Define a relationship with the Address model for the user's address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Define a relationship with the Parcel model for parcels deliverable by this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function deliverableParcels()
    {
        return $this->hasManyThrough(Parcel::class, Vehicle::class, 'current_driver_id', 'vehicle_id');
    }

    /**
     * Define a relationship with the Vehicle model for vehicles associated with this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }
}
