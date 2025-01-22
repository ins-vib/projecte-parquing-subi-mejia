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


    

    //APARCAR SENSE COTXE

    public function aparcar1($id) {
        $parking=Parking::find($id);

        return view('aparcar.aparcar1')->with('parking', $parking);
    }

    public function aparcar1enviar($id, Request $request) {
        $parking = Parking::find($id);
        if (!$parking) {
            return redirect()->back()->with('error', 'Parking no trobat');
        }
        $parking->plaçes_ocupades = $parking->plaçes_ocupades + 1;
        $parking->save();
        return redirect()->back()->with('parking', $parking);
    }

    public function desaparcar1enviar($id, Request $request) {
        $parking = Parking::find($id);
        if (!$parking) {
            return redirect()->back()->with('error', 'Parking no trobat');
        }
        $parking->plaçes_ocupades = $parking->plaçes_ocupades - 1;
        $parking->save();
        return redirect()->back()->with('parking', $parking);
    }




    //APARCAR AMB COTX

    public function cotxeAfegir($parking_id) {
        return view('aparcar.afegircotxe', ['parking_id' => $parking_id]);
    }

    public function cotxeEnviar(Request $request) {

        $validatedData = $request->validate([
            'matricula' => ['required', 'regex:/^[0-9]{4}[A-Z]{3}$/'],
            'marca_cotxe' => 'required|string|max:25',
            'model_cotxe' => 'required|string|max:25',
        ]);
        $validatedData['user_id'] = auth()->id();
        
        $cotxe = Cotxe::Create($validatedData);
        $cotxe->save();
        return redirect()->route('aparcar.llistacotxes', ['id' => $request->parking_id]);
    }

    public function eliminarCotxe($id) {
        $cotxe = Cotxe::findOrFail($id);
        Plaza::where('cotxe_id', $id)->update(['cotxe_id' => null, 'estat' => 1]);
        $cotxe->delete();

        return redirect()->back();
    }

    public function aparcarCotxes($id, Request $request) {
        $buscar = request('buscar');        
        $parking = Parking::findOrFail($id);

        $cotxes = Cotxe::where('user_id', auth()->user()->id)
        ->when($buscar, function($query) use ($buscar) {
            return $query->where(function($q) use ($buscar) {
                $q->where('matricula', 'like', "%{$buscar}%")
                  ->orWhere('marca_cotxe', 'like', "%{$buscar}%")
                  ->orWhere('model_cotxe', 'like', "%{$buscar}%");
            });
        })
        ->get();

        return view('aparcar.llistacotxes')->with('cotxes', $cotxes)->with('parking', $parking)->with('buscar', $buscar);
    }


    public function aparcarParkingPlantes($id, $cotxe_id) {
        $parking = Parking::findOrFail($id);
        $plantes = Zona::where('parking_id', $id)->get();
        $cotxe = Cotxe::findOrFail($cotxe_id);
        return view('aparcar.parkingplantas')->with('parking', $parking)->with('plantes', $plantes)->with('cotxe', $cotxe);
    }

    public function aparcarParkingPlazas($parking_id, $cotxe_id, $id) {
        $parking = Parking::findOrFail($parking_id);
        $planta = Zona::findOrFail($id);
        $plaçes = Plaza::where('zona_id', $id)->get();
        $cotxe = Cotxe::findOrFail($cotxe_id);
        return view('aparcar.parkingplazas')->with('planta', $planta)->with('plaçes', $plaçes)->with('parking', $parking)->with('cotxe', $cotxe);
    }

    public function enviaraparcarParkingPlazas($id, Request $request) {
        $plaça = Plaza::findOrFail($id); 
        $parking = Parking::findOrFail($plaça->zona->parking_id);
        $parking->plaçes_ocupades = $parking->plaçes_ocupades + 1;

        $plaça->estat = 0; 
        $plaça->cotxe_id = $request->cotxe_id;
        $plaça->save();    
        $parking->save();
        return redirect()->back();
    }

    public function desaparcar($id) {
        $plaça = Plaza::findOrFail($id); 
        $parking = Parking::findOrFail($plaça->zona->parking_id);
        $parking->plaçes_ocupades = $parking->plaçes_ocupades - 1;

        $plaça->estat = 1; 
        $plaça->save();    
        $parking->save();
        return redirect()->back();
    }

}
