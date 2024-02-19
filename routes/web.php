<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('base');
});
    //ROUTES POUR CLIENTS
    Route::get('/clients', [HotelController::class, 'clients'])->name('Clients List');
    Route::get('/clients/create', [HotelController::class, 'clientsAdd'])->name('Clients Add');
    Route::post('/clients', [HotelController::class, 'clientsStore'])->name('Clients Store');
    Route::get('/clients/{id}/edit', [HotelController::class, 'clientsEdit'])->name('Clients Edit');
    Route::put('/clients/{id}', [HotelController::class, 'clientsUpdate'])->name('Clients Update');
    Route::delete('/clients/{id}', [HotelController::class, 'clientsDestroy'])->name('Clients Destroy');
    //ROUTES POUR CHAMBRES
    Route::get('/chambres', [HotelController::class, 'chambres'])->name('Chambres List');
    Route::get('/chambres/create', [HotelController::class, 'chambresAdd'])->name('Chambres Add');
    Route::post('/chambres', [HotelController::class, 'chambresStore'])->name('Chambres Store');
    Route::get('/chambres/{id}/edit', [HotelController::class, 'chambresEdit'])->name('Chambres Edit');
    Route::put('/chambres/{id}', [HotelController::class, 'chambresUpdate'])->name('Chambres Update');
    Route::delete('/chambres/{id}', [HotelController::class, 'chambresDestroy'])->name('Chambres Destroy');
    //ROUTES POUR RESERVATIONS
    Route::get('/reservations', [HotelController::class, 'reservations'])->name('Reservations List');
    Route::get('/reservations/create', [HotelController::class, 'reservationsAdd'])->name('Reservations Add');
    Route::post('/reservations', [HotelController::class, 'reservationsStore'])->name('Reservations Store');
    Route::get('/reservations/{id}/edit', [HotelController::class, 'reservationsEdit'])->name('Reservations Edit');
    Route::put('/reservations/{id}', [HotelController::class, 'reservationsUpdate'])->name('Reservations Update');
    Route::delete('/reservations/{id}/delete', [HotelController::class, 'reservationsDestroy'])
    ->name('Reservations Destroy')
    ->withoutMiddleware(['csrf']);
    //ROUTES POUR HISTORIQUES
    Route::get('/historiques', [HotelController::class, 'showReservationHistory'])->name('Historiques List');
