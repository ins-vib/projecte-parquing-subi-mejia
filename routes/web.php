<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\PlazaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/parkings', [ParkingController::class,'llista'])->name('parkings.llista');
Route::get('/parkings/informacio/{id}', [ParkingController::class,'informacio'])->name('parkings.informacio');

Route::get('/zona/llista/{id}', [ZonaController::class,'llista'])->name('zona.llista');

Route::get('/plaza', [PlazaController::class,'llista'])->name('plaza.llista');


require __DIR__.'/auth.php';
