<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'weight',
        'notes',
        'status',
    ];

    public function receiver()
    {
        return $this->belongsTo(Client::class, 'receiver_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function source()
    {
        return $this->belongsTo(Address::class, 'source');
    }

    public function destination()
    {
        return $this->belongsTo(Address::class, 'destination');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function tariff()
    {
        return $this->belongsTo(Tariff::class, 'tariff_id');
    }

    // TODO setup parcel tracking
    public function parcelTracking()
    {
        return $this->hasOne(ParcelTracking::class);
    }
}
