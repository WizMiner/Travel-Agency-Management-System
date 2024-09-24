<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('traveling/about/{id}', [App\Http\Controllers\Traveling\TravelingController::class, 'about'])->name('traveling.about');

// Booking
Route::get('traveling/reservation/{id}', [App\Http\Controllers\Traveling\TravelingController::class, 'makeReservations'])->name('traveling.reservations');

Route::get('traveling/reservation/{id}', [App\Http\Controllers\Traveling\TravelingController::class, 'makeReservations'])->name('traveling.reservation');
