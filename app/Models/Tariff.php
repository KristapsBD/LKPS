<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'extra_information',
        'is_public',
    ];

    /**
     * Define a relationship with the Parcel model for parcels associated with this tariff.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }
}
