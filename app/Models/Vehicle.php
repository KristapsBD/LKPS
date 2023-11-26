<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

//    TODO add missing status fields to tables from conceptual model
// TODO add missing payments table
    protected $fillable = [
        'registration_number',
        'type',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }
}
