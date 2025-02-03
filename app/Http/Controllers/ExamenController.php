<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use Carbon\Carbon;

class ExamenController extends Controller
{
    public function llistat()
    {
        $now = Carbon::now(); // Obtiene la hora actual
        $parkings = Parking::with('zonas', 'tarifa')->get(); // Cargar relaciones necesarias

        $data = $parkings->map(function ($parking) use ($now) {
            // Comprobar si el parking está abierto
            $parking->is_open = $now->between($parking->horaObertura, $parking->horaTancament);
            // Comprobar si hay plazas disponibles
            $parking->has_free_spaces = ($parking->capacitat - $parking->plaçes_ocupades) > 0;
            return $parking;
        });

        return view('examen.llistat', compact('data'));
    }
}
