<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Zona;
use App\Models\Plaza;
use App\Models\Tipusplaçes;

class PlazaController extends Controller
{
    //

    public function llista() {
        $plaçes = Plaza::with('parking')->get();
        $plaçes = Plaza::Paginate(15);
        return view('plaza.llista')->with('plaçes', $plaçes);
    }

    public function mostrarPlaçes($id) {
        $planta = Zona::findOrFail($id);
        $plaçes = Plaza::where('zona_id', $id)->paginate(15);
        return view('plaza.planta')->with('planta', $planta)->with('plaçes', $plaçes);
    }

    public function bloq($id, Request $request,) {
        $plaça = Plaza::findOrFail($id);
        $parking = Parking::findOrFail($plaça->zona->parking_id);
        $nouEstat = $request->bloquejat;
        if ($nouEstat == 1 && $plaça->bloquejat == 0) {
            $parking->plaçes_ocupades = $parking->plaçes_ocupades + 1;
            $parking->save();
        }
        else if ($nouEstat == 0 && $plaça->bloquejat == 1) {
            $parking->plaçes_ocupades = $parking->plaçes_ocupades - 1;
            $parking->save();
        }
        $plaça->bloquejat = $nouEstat;
        $plaça->save();
        return response()->json(['success' => true]);
    }
}
