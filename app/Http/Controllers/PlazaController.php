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

    public function afegirForm() {
        $zones = Zona::with('parking')->get();
        $tipusPlaces = Tipusplaçes::all();
        return view('plaza.afegir')->with('zones', $zones)->with('tipusPlaces', $tipusPlaces);
    }

   public function afegir(Request $request) {
        $request->validate([
            'zona_id' => 'required|exists:zonas,id',
            'tipus_id' => 'required|exists:tipusplaçes,id',
            'numero' => 'required|integer|min:1',
        ]);

        $zona = Zona::findOrFail($request->zona_id);
        $parking = $zona->parking;

        Plaza::create([
            'zona_id' => $zona->id,
            'tipus_id' => $request->tipus_id,
            'numero' => $request->numero,
            'estat' => 1,
            'bloquejat' => 0,
        ]);

        $zona->capacitatTotal += 1;
        $zona->save();

        $parking->capacitat += 1;
        $parking->save();

        return redirect()->route('zona.llista')->with('success', 'Plaça afegida correctament');
    }

    public function eliminar($id) {
        $plaza = Plaza::findOrFail($id);
        $zona = $plaza->zona;
        $parking = $zona->parking;

        $plaza->delete();

        $zona->capacitatTotal = max(0, $zona->capacitatTotal - 1);
        $zona->save();

        $parking->capacitat = max(0, $parking->capacitat - 1);
        $parking->save();

        return redirect()->back()->with('success', 'Plaça eliminada correctament');
    }

    public function editarForm($id) {
        $plaza = Plaza::findOrFail($id);
        $tipus = TipusPlaçes::all();

        return view('plaza.editar')->with('plaza', $plaza)->with('tipus', $tipus);
    }

    public function editar(Request $request, $id) {
        $request->validate([
            'tipus_id' => 'required|exists:tipusplaçes,id',
            'numero' => 'required|string|max:255',
        ]);

        $plaza = Plaza::findOrFail($id);
        $plaza->tipus_id = $request->tipus_id;
        $plaza->numero = $request->numero;
        $plaza->save();

        return redirect()->route('zona.llista')->with('success', 'Plaça editada correctament');
    }

}
