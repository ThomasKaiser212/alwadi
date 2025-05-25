<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacity',
        'price_per_night',
        'size',
        'description',
    ];

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    public function scopeReserved($query)
    {
        return $query->whereHas('bookings');
    }
}
