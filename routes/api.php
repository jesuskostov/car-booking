<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{car_id}', [BookingController::class, 'getBookingsByCarId']);

Route::get('/cars', [CarController::class, 'index']);
Route::post('/cars/availability', [CarController::class, 'checkAvailability']);
Route::post('/cars/ask-email', [CarController::class, 'askEmail']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
