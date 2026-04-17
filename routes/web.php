<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EnrolleeController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn() => view('landing'))->name('landing');

Route::get('/dashboard', [EnrolleeController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/enrollees', [EnrolleeController::class, 'store'])->name('enrollees.store'); 
    Route::put('/enrollees/{enrollee}', [EnrolleeController::class, 'update'])->name('enrollees.update'); 
    Route::delete('/enrollees/{enrollee}', [EnrolleeController::class, 'destroy'])->name('enrollees.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); 
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); 
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 
});

require __DIR__.'/auth.php';