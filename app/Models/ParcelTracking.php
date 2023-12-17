<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'old_status',
        'new_status',
        'location',
    ];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
}
