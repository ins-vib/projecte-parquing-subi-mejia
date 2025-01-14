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

        $parking = Parking::findOrFail($plaça->zona->parking_id);
        $parking->plaçes_ocupades = $parking->plaçes_ocupades + 1;

        $plaça->estat = 0; 
        $plaça->save();    
        $parking->save();
        return redirect()->back();
    }

    public function aparcar1($id) {
        $parking=Parking::find($id);

        return view('aparcar.aparcar1')->with('parking', $parking);
    }

    public function aparcar1enviar($id) {
        $parking=Parking::find($id);

        return view('aparcar.aparcar1')->with('parking', $parking);
    }
}
