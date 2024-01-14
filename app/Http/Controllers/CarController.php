<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use DateTime;
use Illuminate\Support\Facades\Log;
use App\Mail\BookingConfirmationMail;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return response()->json($cars, 200);
    }

    public function checkAvailability(Request $request)
    {
        // check all cars availability for the selected dates (start_date, end_date) and return only available cars
        $cars = Car::all();
        $available_cars = [];
        $available_brands = [];

        // Convert start_date from dd.mm.yyyy to yyyy-mm-dd format
        $start_date = DateTime::createFromFormat('d.m.Y', $request->start_date);
        $formatted_start_date = $start_date ? $start_date->format('Y-m-d') : null;

        // Convert end_date from dd.mm.yyyy to yyyy-mm-dd format
        $end_date = DateTime::createFromFormat('d.m.Y', $request->end_date);
        $formatted_end_date = $end_date ? $end_date->format('Y-m-d') : null;

        if (!$formatted_start_date || !$formatted_end_date) {
            return response()->json(['message' => 'Invalid date format'], 422);
        }

        foreach ($cars as $car) {
            if ($car->isAvailableForDates($formatted_start_date, $formatted_end_date)) {
                array_push($available_cars, $car);
                array_push($available_brands, $car->brand);
            }
        }
        return response()->json(['cars'=> $available_cars, 'brands' => $available_brands], 200);
    }

    public function askEmail(Request $request) {
        $car = Car::find($request->car_id);
        $name = $request->name;
        $phone = $request->phone;
        $start_date = DateTime::createFromFormat('d.m.Y', $request->start_date)->format('Y-m-d');
        $end_date = DateTime::createFromFormat('d.m.Y', $request->end_date)->format('Y-m-d');

        \Mail::to('jesuskostov@gmail.com')->send(new BookingConfirmationMail($car, $start_date, $end_date, $name, $phone));

        return response()->json(['message' => 'Email sent successfully']);

    }
}
