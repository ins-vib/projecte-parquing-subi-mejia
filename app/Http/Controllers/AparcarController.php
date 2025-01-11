<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Plaza;
use App\Models\Zona;

class AparcarController extends Controller
{
    //

    public function aparcar() {
        $parkings = Parking::all();
        return view('aparcar.aparcar')->with('parkings', $parkings);
    }

    public function aparcarParkingPlantes($id) {
        $parking = Parking::findOrFail($id);
        $plantes = Zona::where('parking_id', $id)->get();
        return view('aparcar.parkingplantas')->with('parking', $parking)->with('plantes', $plantes);
    }

    public function aparcarParkingPlazas($id) {
        $planta = Zona::findOrFail($id);
        $plaçes = Plaza::where('zona_id', $id)->get();
        return view('aparcar.parkingplazas')->with('planta', $planta)->with('plaçes', $plaçes);
    }

    public function enviaraparcarParkingPlazas($id) {
        $plaça = Plaza::findOrFail($id); 
        $plaça->estat = 0; 
        $plaça->save();    
        return redirect()->back();
    }
}
