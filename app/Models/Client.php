<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * Define a relationship with the Parcel model for parcels received by the client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parcels()
    {
        return $this->belongsTo(Parcel::class, 'receiver_id');
    }
}
