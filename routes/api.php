<?php

use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/hello', function (Request $request) {  
    return json_encode("Hello, world!");
});

Route::resource("/holidays", HolidayController::class);
Route::resource("/locations", LocationController::class);
Route::resource("/reservations", ReservationController::class);

Route::put("/locations", [LocationController::class, "update"]);
Route::put("/holidays", [HolidayController::class, "update"]);
Route::put("/reservations", [ReservationController::class, "update"]);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
