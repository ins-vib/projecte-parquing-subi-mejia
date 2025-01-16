<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\PlazaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlateController;
use App\Http\Controllers\AparcarController;
use App\Http\Controllers\CotxeController;

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

//GESTIONS DES DE ADMIN
Route::group(['middleware'=>['auth','role:admin']], function() {
    Route::get('/parkings', [ParkingController::class,'llista'])->name('parkings.llista');
    Route::get('/parkings/informacio/{id}', [ParkingController::class,'informacio'])->name('parkings.informacio');
    Route::get('/parkings/afegir', [ParkingController::class,'formAfegir'])->name('parkings.formAfegir');
    Route::post('/parkings/afegir', [ParkingController::class,'afegir'])->name('parkings.afegir');
    Route::get('/parkings/editar/{id}', [ParkingController::class,'formEditar'])->name('parkings.formEditar');
    Route::post('/parkings/editar/{id}', [ParkingController::class,'editar'])->name('parkings.editar');
    Route::get('/parkings/eliminar/{id}', [ParkingController::class,'eliminar'])->name('parkings.eliminar');  

    
    Route::get('/plantes', [ZonaController::class,'llista'])->name('zona.llista');
    Route::get('/plantes/llista/{{id}}', [ZonaController::class,'informacio'])->name('zona.informacio');


    Route::get('/plaçes', [PlazaController::class,'llista'])->name('plaza.llista');
    Route::get('/plaçes/planta/{id}', [PlazaController::class,'mostrarPlaçes'])->name('plaza.planta');
});



//GESTIONS DES DE NORMAL
Route::group(['middleware'=>['auth','role:normal']], function() {
    Route::get('/aparcar', [AparcarController::class,'aparcar'])->name('aparcar.aparcar');
    Route::get('/aparcar/cotxes/{id}', [AparcarController::class,'aparcarCotxes'])->name('aparcar.llistacotxes');
    Route::get('/aparcar/cotxes/afegir', [AparcarController::class, 'cotxeAfegir'])->name('aparcar.afegircotxe');
    Route::post('/aparcar/cotxes/afegir', [AparcarController::class, 'cotxeEnviar'])->name('aparcar.enviarcotxe');
    Route::get('/cotxes/eliminar/{id}', [AparcarController::class,'eliminarCotxe'])->name('aparcar.eliminarcotxe');  
    Route::get('/aparcar/cotxes/{parking_id}/plantes/{cotxe_id}', [AparcarController::class,'aparcarParkingPlantes'])->name('aparcar.parkingplantas');
    Route::get('/aparcar/cotxes/{parking_id}/plantes/{cotxe_id}/{id}', [AparcarController::class,'aparcarParkingPlazas'])->name('aparcar.parkingplazas');
    Route::post('/aparcar/cotxes/{parking_id}/plantes/{cotxe_id}/{id}', [AparcarController::class,'enviaraparcarParkingPlazas'])->name('aparcar.enviarparkingplazas');
    Route::get('/aparcar/tipus1/{id}', [AparcarController::class,'aparcar1'])->name('aparcar.aparcar1');
    Route::post('/aparcar/tipus1/{id}', [AparcarController::class,'aparcar1enviar'])->name('aparcar.aparcar1enviar');
});


Route::get('/detecta-matricula', [PlateController::class, 'detectaMatricula']);


require __DIR__.'/auth.php';

