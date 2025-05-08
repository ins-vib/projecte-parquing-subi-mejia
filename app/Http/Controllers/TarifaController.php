<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use  App\Models\Tarifa;
use App\Models\Parking;

class TarifaController extends Controller
{
    //

    public function llista() {
        $tarifes = Tarifa::paginate(5);
        return view("tarifes.llista")->with('tarifes',$tarifes);
    }

    public function formAfegir() {
        return view("tarifes.afegir");
    }

    public function afegirEnviar(Request $request) {
        $request->validate([
            'preu' => 'required|numeric|min:0',
        ]);
        $tarifes = new Tarifa();
        $tarifes->preu = $request->input('preu');
        $tarifes->save();
        return redirect()->route('tarifes.llista');
    }

    public function eliminar($id) {
        $tarifes = Tarifa::findOrFail($id);
        Parking::where('tarifa_id', $tarifes->id)->update(['tarifa_id' => null]);
        $tarifes->delete();
        return redirect()->route('tarifes.llista');
    }
}
