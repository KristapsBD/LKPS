<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'city',
        'postal_code',
    ];

    public function sender()
    {
        return $this->hasMany(User::class);
    }

    public function receiver()
    {
        return $this->hasMany(Client::class);
    }
}
