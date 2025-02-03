<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use Carbon\Carbon;

class ExamenController extends Controller
{
    public function llistat()
    {
        $now = Carbon::now(); // 
        $parkings = Parking::with('zonas', 'tarifa')->get(); 

        $data = $parkings->map(function ($parking) use ($now) {

            $parking->is_open = $now->between($parking->horaObertura, $parking->horaTancament);

            $parking->has_free_spaces = ($parking->capacitat - $parking->plaçes_ocupades) > 0;
            return $parking;
        });

        return view('examen.llistat', compact('data'));
    }
}