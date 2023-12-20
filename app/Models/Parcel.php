<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// TODO fix error when parcel foreign key is null and listing page tries to read value (cond format)

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

    // TODO setup parcel tracking
    public function parcelTracking()
    {
        return $this->hasMany(ParcelTracking::class);
    }
}
