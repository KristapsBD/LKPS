<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'weight',
        'notes',
        'status',
        'tracking_code',
    ];

    protected static function booted()
    {
        static::creating(function ($parcel) {
            $parcel->tracking_code = Str::random(10);
        });
    }

    public function receiver()
    {
        return $this->belongsTo(Client::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function source()
    {
        return $this->belongsTo(Address::class, 'source_id');
    }

    public function destination()
    {
        return $this->belongsTo(Address::class, 'destination_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

    public function parcelTracking()
    {
        return $this->hasMany(ParcelTracking::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
