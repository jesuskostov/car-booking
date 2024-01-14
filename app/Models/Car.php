<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand',
        'model',
        'year',
        'color',
        'gearbox',
        'fuel_type',
        'fuel_consumption_city',
        'fuel_consumption_urban',
        'fuel_consumption_combined',
        'price_1',
        'price_2',
        'price_3',
        'price_week',
        'price_month',
        'image',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailableForDates($startDate, $endDate)
    {
        return !$this->bookings()->where(function ($query) use ($startDate, $endDate) {
            $query->where(function($q) use ($startDate, $endDate) {
                $q->where('start_date', '<=', $endDate)
                ->where('end_date', '>=', $startDate);
            });
        })->exists();
    }


    public function updateAvailability()
    {
        $now = now()->format('Y-m-d');

        $hasActiveBooking = $this->bookings()
                                ->where('start_date', '<=', $now)
                                ->where('end_date', '>=', $now)
                                ->exists();

        $this->is_available = !$hasActiveBooking;
        $this->save();
    }


    public function getNameModelAttribute()
    {
        return "{$this->brand} - {$this->model}";
    }

}
