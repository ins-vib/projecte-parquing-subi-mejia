<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Plaza;
use App\Models\Zona;
use App\Models\Cotxe;

class AparcarController extends Controller
{
    //

    public function aparcar() {
        $parkings = Parking::all();
        return view('aparcar.aparcar')->with('parkings', $parkings);
    }

    public function aparcar1($id) {
        $parking=Parking::find($id);

        return view('aparcar.aparcar1')->with('parking', $parking);
    }

    public function aparcar1enviar($id, Request $request) {
        $parking=Parking::find($id);
        return view('aparcar.aparcar1')->with('parking', $parking);
    }




    //APARCAR AMB COTX

    public function cotxeAfegir() {
        return view('aparcar.afegircotxe');
    }

    public function cotxeEnviar(Request $request) {

        $validatedData = $request->validate([
            'matricula' => ['required', 'regex:/^[0-9]{4}[A-Z]{3}$/'],
            'marca_cotxe' => 'required|string|max:25',
            'model_cotxe' => 'required|string|max:25',
        ]);
        
        $cotxe = Cotxe::Create($validatedData);
        $cotxe->save();
        return redirect('/aparcar/cotxes')->with('cotxes.llista');
    }

    public function eliminarCotxe($id) {
        $cotxe = Cotxe::findOrFail($id);
        $cotxe->delete();

        return redirect()->route('aparcar.llistacotxes');
    }

    public function aparcarCotxes($id) {
        $cotxes = Cotxe::all();
        $parking = Parking::findOrFail($id);

        return view('aparcar.llistacotxes')->with('cotxes', $cotxes)->with('parking', $parking);
    }


    public function aparcarParkingPlantes($id, $cotxe_id) {
        $parking = Parking::findOrFail($id);
        $plantes = Zona::where('parking_id', $id)->get();
        $cotxe = Cotxe::findOrFail($cotxe_id);
        return view('aparcar.parkingplantas')->with('parking', $parking)->with('plantes', $plantes)->with('cotxe', $cotxe);
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

}
