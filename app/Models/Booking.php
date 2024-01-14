<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'start_date', 'end_date'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function car()
    {
         return $this->belongsTo(Car::class);
    }
    
    protected static function booted()
    {
        static::created(function ($booking) {
            $booking->car->updateAvailability();
        });

        static::updated(function ($booking) {
            $booking->car->updateAvailability();
        });

        static::deleted(function ($booking) {
            $booking->car->updateAvailability();
        });
    }


}
