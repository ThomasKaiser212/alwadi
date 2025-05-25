<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'phone_number',
        'destination',
        'reservation_time',
        'number_of_people',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
