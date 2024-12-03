<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Zona;

class ParkingController extends Controller
{
    //

    public function llista() {
        
        $parkings= Parking::all();
        return view("parkings.llista")->with('parkings',$parkings);
    }

    public function informacio($id) {
        $zonas=Zona::where('parking_id', $id)->get();
        $parkings=Parking::find($id);
        return view("parkings.informacio")->with('parkings', $parkings)->with('zonas', $zonas);
    }

    public function formAfegir() {
        return view("parkings.afegir");
    }

    public function afegir(Request $request) {

        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'ciutat' => 'required',
            'capacitat' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'horaObertura' => 'required',
            'horaTancament' => 'required',
        ]);
        
        $parkings = new Parking();

        $parkings->name = $validated['name'];
        $parkings->address = $validated['adress'];
        $parkings->ciutat = $validated['ciutat'];
        $parkings->capacitat = $validated['capacitat'];
        $parkings->latitud = $validated['latitud'];
        $parkings->longitud = $validated['nombre'];
        $parkings->horaObertura = $validated['horaObertura'];
        $parkings->horaTancament = $validated['horaTancament'];
        
        $parkings->save();
        return redirect("/parkings");
    }

}
