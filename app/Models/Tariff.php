<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'extra_information',
    ];
    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }
}
