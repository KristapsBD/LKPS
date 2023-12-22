<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

//    TODO add missing status fields to tables from conceptual model
    protected $fillable = [
        'registration_number',
        'type',
        'status',
    ];

    public function current_driver()
    {
        return $this->belongsTo(User::class);
    }

    public function drivers()
    {
        return $this->belongsToMany(User::class);
    }

    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }
}
