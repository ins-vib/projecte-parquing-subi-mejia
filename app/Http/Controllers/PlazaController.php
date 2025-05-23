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
        $plaça->bloquejat = $request->input('bloquejat');
        $plaça->save();
        return response()->json(['success' => true]);
    }
}
