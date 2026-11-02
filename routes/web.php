<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// --- Inscriptions ---
Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->name('registrations.store');
Route::get('/registrations/{registration}', [RegistrationController::class, 'show'])->name('registrations.show');
Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');