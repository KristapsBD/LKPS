<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sum',
        'status',
    ];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
}
