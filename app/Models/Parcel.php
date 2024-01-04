<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Parcel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'size',
        'weight',
        'notes',
        'status',
        'tracking_code',
    ];

    /**
     * Boot the Parcel model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($parcel) {
            // Generate a random tracking code before creating a new Parcel.
            $parcel->tracking_code = Str::random(10);
        });
    }

    /**
     * Define a relationship with the Client model for the parcel receiver.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Define a relationship with the User model for the parcel sender.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define a relationship with the Address model for the parcel source address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source()
    {
        return $this->belongsTo(Address::class, 'source_id');
    }

    /**
     * Define a relationship with the Address model for the parcel destination address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destination()
    {
        return $this->belongsTo(Address::class, 'destination_id');
    }

    /**
     * Define a relationship with the Vehicle model for the associated vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Define a relationship with the Tariff model for the associated tariff.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

    /**
     * Define a relationship with the ParcelTracking model for the parcel's tracking information.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parcelTracking()
    {
        return $this->hasMany(ParcelTracking::class);
    }

    /**
     * Define a relationship with the Payment model for the associated payment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
