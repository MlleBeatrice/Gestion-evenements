<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

// Routes pour les inscriptions
Route::post('/events/{id}/register', [RegistrationController::class, 'store'])->name('registrations.store');
Route::delete('/registrations/{id}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
Route::get('/', function () {
    return view('welcome');
});
