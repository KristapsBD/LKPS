<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// TODO ADD client - address relationship
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
    ];

    public function parcels()
    {
        return $this->belongsTo(Parcel::class, 'receiver_id');
    }
}
