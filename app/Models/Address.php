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

    // TODO refactor address structure - only user has default address
    // TODO CHECK UP ALL CONSTRAINTS
    public function sender()
    {
        return $this->hasMany(User::class);
    }

    public function receiver()
    {
        return $this->hasMany(Client::class);
    }
}
