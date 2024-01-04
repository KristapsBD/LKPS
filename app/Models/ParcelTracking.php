<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelTracking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'old_status',
        'new_status',
        'location',
    ];

    /**
     * Define a relationship with the Parcel model for the associated parcel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
}
