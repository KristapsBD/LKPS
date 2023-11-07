<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'weight',
        'notes',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'sender_client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }
}
