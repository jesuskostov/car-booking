<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use DateTime;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $car = Car::find($request->car_id);

        // Convert start_date from dd.mm.yyyy to yyyy-mm-dd format
        $start_date = DateTime::createFromFormat('d.m.Y', $request->start_date);
        $formatted_start_date = $start_date ? $start_date->format('Y-m-d') : null;

        // Convert end_date from dd.mm.yyyy to yyyy-mm-dd format
        $end_date = DateTime::createFromFormat('d.m.Y', $request->end_date);
        $formatted_end_date = $end_date ? $end_date->format('Y-m-d') : null;

        // Check if the date conversion was successful
        if (!$car || !$car->isAvailableForDates($formatted_start_date, $formatted_end_date)) {
            return response()->json(['message' => 'Car is not available for the selected dates'], 422);
        }


        if (!$car || !$car->isAvailableForDates($request->start_date, $request->end_date)) {
            return response()->json(['message' => 'Car is not available for the selected dates'], 422);
        }

        $booking = new Booking();
        $booking->car_id = $request->car_id;
        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->save();


        return response()->json(['message' => 'Booking created successfully', 'booking' => $booking], 201);
    }

    public function getBookingsByCarId($car_id)
    {
        $bookings = Booking::where('car_id', $car_id)->get();

        return response()->json($bookings, 200);
    }

    public function confirm(Request $request)
    {
        $carId = $request->input('car_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $car = Car::find($carId);

        $start_date_object = DateTime::createFromFormat('Y-m-d', $startDate);
        $formatted_start_date = $start_date_object ? $start_date_object->format('d.m.Y') : null;

        $end_date_object = DateTime::createFromFormat('Y-m-d', $endDate);
        $formatted_end_date = $end_date_object ? $end_date_object->format('d.m.Y') : null;

        if (!$car || !$car->isAvailableForDates($startDate, $endDate)) {
            return '<h1 style="color:red">Колата не е налична за избраните дати</h1>';
        }

        $booking = new Booking();
        $booking->car_id = $carId;
        $booking->start_date = $startDate;
        $booking->end_date = $endDate;
        $booking->save();

        return view('booking_confirmed', ['booking' => $booking]);
    }




}
