<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\PlazaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlateController;
use App\Http\Controllers\AparcarController;
use App\Http\Controllers\CotxesController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TarifaController;
use App\Http\Controllers\TransaccioController;

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
    Route::get('/plantes/llista/{id}', [ZonaController::class,'informacio'])->name('zona.informacio');
    Route::get('/plantes/afegir', [ZonaController::class, 'formAfegir'])->name('zona.formAfegir');
    Route::post('/plantes/afegir', [ZonaController::class, 'afegir'])->name('zona.afegir');
    Route::get('/plantes/editar/{id}', [ZonaController::class, 'formEditar'])->name('zona.editar');
    Route::post('/plantes/editar/{id}', [ZonaController::class, 'editar'])->name('zona.editar');
    Route::get('/plantes/eliminar/{id}', [ZonaController::class, 'eliminar'])->name('zona.eliminar');


    Route::get('/plaçes', [PlazaController::class,'llista'])->name('plaza.llista');
    Route::get('/plaçes/planta/{id}', [PlazaController::class,'mostrarPlaçes'])->name('plaza.planta');
    Route::post('/plaçes/{id}/bloq', [PlazaController::class, 'bloq']);

    Route::get('/cotxes', [CotxesController::class,'llista'])->name('cotxes.llista');
    Route::get('/cotxes/afegir/admin', [CotxesController::class,'cotxeAfegirAdmin'])->name('cotxes.afegircotxeadmin');
    Route::post('/cotxes/afegir/admin', [CotxesController::class,'cotxeAfegirAdminEnviar'])->name('cotxes.afegircotxeadmin');
    Route::get('/cotxes/eliminar/admin/{id}', [CotxesController::class,'eliminar'])->name('cotxes.eliminar');
    Route::get('/cotxes/editar/{id}', [CotxesController::class,'cotxeEditar'])->name('cotxes.editar');
    Route::post('/cotxes/editar/{id}', [CotxesController::class,'cotxeEditarEnviar'])->name('cotxes.editar');
    

    Route::get('/parkings/{id}/imatges', [ParkingController::class, 'mostrarImatges'])->name('parkings.imatges');
    Route::post('/parkings/pujar-imatges', [ParkingController::class, 'pujarImatges'])->name('parkings.pujarImatges');

    Route::get('/tarifes', [TarifaController::class, 'llista'])->name('tarifes.llista');
    Route::get('/tarifes/afegir', [TarifaController::class, 'formAfegir'])->name('tarifes.afegir');
    Route::post('/tarifes/afegir', [TarifaController::class, 'afegirEnviar'])->name('tarifes.afegir');
    Route::get('/tarifes/eliminar/{id}', [TarifaController::class, 'eliminar'])->name('tarifes.eliminar');

    Route::get('/transaccions', [TransaccioController::class, 'llista'])->name('transaccions.llista');
});


//GESTIONS D'OPERADOR
Route::group(['middleware'=>['auth','role:operador']], function() {
    Route::get('/parkings/operador', [ParkingController::class,'llistaOperador'])->name('operador.llistaparkings');
    Route::get('/aparcar/tipus1/{id}', [AparcarController::class,'aparcar1'])->name('aparcar.aparcar1');
    Route::post('/aparcar/tipus1/{id}', [AparcarController::class,'aparcar1enviar'])->name('aparcar.aparcar1enviar');
    Route::post('/desaparcar/tipus1/{id}', [AparcarController::class,'desaparcar1enviar'])->name('aparcar.desaparcar1enviar');

    Route::get('/aparcar/operador/cotxes/{parking_id}/plantes/{cotxe_id}', [ParkingController::class,'aparcarParkingPlantesOperador'])->name('operador.plantes');
    Route::get('/aparcar/operador/cotxes/{parking_id}/plantes/{cotxe_id}/{id}', [ParkingController::class,'aparcarParkingPlazasOperador'])->name('operador.plaçes');
    Route::post('/aparcar/operador/{id}', [ParkingController::class,'enviaraparcarParkingPlazasOperador'])->name('aparcar.enviarparkingplazas');
    Route::get('/aparcar/operador/cotxes/{parking_id}/plantes/{cotxe_id}/{id}', [ParkingController::class,'aparcarParkingPlazasOperador'])->name('aparcar.parkingplazas');
    Route::post('/desaparcar/operador/{id}', [ParkingController::class,'desaparcarOperador'])->name('aparcar.desaparcar');

    Route::get('/aparcar/cotxes/operador/{id}', [ParkingController::class,'aparcarCotxesOperador'])->name('operador.llistacotxes');
});



//GESTIONS DES DE NORMAL
Route::group(['middleware'=>['auth','role:normal']], function() {
    Route::get('/aparcar', [AparcarController::class,'aparcar'])->name('aparcar.aparcar');
    Route::get('/aparcar/cotxes', [AparcarController::class,'llistaCotxes'])->name('aparcar.llistacotxes2');
    Route::get('/aparcar/elsteuscotxes', [AparcarController::class,'cotxeLlistaBase'])->name('aparcar.llistacotxesbase');
    Route::get('/aparcar/elsteuscotxes/afegir', [AparcarController::class,'cotxeAfegirBase'])->name('aparcar.afegircotxebase');
    Route::post('/aparcar/elsteuscotxes/afegir', [AparcarController::class,'cotxeAfegirBaseEnviar'])->name('aparcar.afegircotxebaseenviar');

    Route::get('/aparcar/cotxes/{id}', [AparcarController::class,'aparcarCotxes'])->name('aparcar.llistacotxes');
    Route::get('/aparcar/afegir/{parking_id}', [AparcarController::class, 'cotxeAfegir'])->name('aparcar.afegircotxe');
    Route::post('/aparcar/afegir', [AparcarController::class, 'cotxeEnviar'])->name('aparcar.enviarcotxe')->middleware('auth');
    Route::get('/cotxes/eliminar/{id}', [AparcarController::class,'eliminarCotxe'])->name('aparcar.eliminarcotxe');  
    Route::get('/cotxes/editar/{id}', [AparcarController::class,'editarCotxe'])->name('aparcar.editarcotxe');
    Route::post('/aparcar/editar/{id}', [AparcarController::class,'editarCotxeEnviar'])->name('aparcar.editarcotxe');

    Route::get('/aparcar/cotxes/{parking_id}/plantes/{cotxe_id}', [AparcarController::class,'aparcarParkingPlantes'])->name('aparcar.parkingplantas');
    Route::get('/aparcar/cotxes/{parking_id}/plantes/{cotxe_id}/{id}', [AparcarController::class,'aparcarParkingPlazas'])->name('aparcar.parkingplazas');
    Route::post('/aparcar/{id}', [AparcarController::class,'enviaraparcarParkingPlazas'])->name('aparcar.enviarparkingplazas');
    Route::get('/aparcar/cotxes/{parking_id}/plantes/{cotxe_id}/{id}', [AparcarController::class,'aparcarParkingPlazas'])->name('aparcar.parkingplazas');
    Route::post('/desaparcar/{id}', [AparcarController::class,'desaparcar'])->name('aparcar.desaparcar');
});
Route::get('/tickets/{plaça}', [TicketController::class, 'generarTicket'])->name('tickets.ticket');


Route::get('/detecta-matricula', [PlateController::class, 'detectaMatricula']);


require __DIR__.'/auth.php';

