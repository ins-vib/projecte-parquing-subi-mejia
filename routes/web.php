<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\MapaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlateController;

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

//PARKINGS DES DE ADMIN
Route::group(['middleware'=>['auth','role:admin']], function() {
    Route::get('/parkings', [ParkingController::class,'llista'])->name('parkings.llista');
    Route::get('/parkings/informacio/{id}', [ParkingController::class,'informacio'])->name('parkings.informacio');
    Route::get('/parkings/afegir', [ParkingController::class,'formAfegir'])->name('parkings.formAfegir');
    Route::post('/parkings/afegir', [ParkingController::class,'afegir'])->name('parkings.afegir');
    Route::get('/parkings/editar/{id}', [ParkingController::class,'formEditar'])->name('parkings.formEditar');
    Route::post('/parkings/editar/{id}', [ParkingController::class,'editar'])->name('parkings.editar');
    Route::get('/parkings/eliminar/{id}', [ParkingController::class,'eliminar'])->name('parkings.eliminar');  
});


//ZONES
Route::get('/zona/llista/{id}', [ZonaController::class,'llista'])->name('zona.llista');


//PLAÇES
Route::get('/plaza', [PlazaController::class,'llista'])->name('plaza.llista');



Route::get('/detecta-matricula', [PlateController::class, 'detectaMatricula']);


require __DIR__.'/auth.php';
