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

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'ciutat' => 'required|string|max:255',
            'capacitat' => 'required|integer',
            'longitud' => 'required|numeric',
            'latitud' => 'required|numeric',
            'horaObertura' => 'required|date_format:H:i',
            'horaTancament' => 'required|date_format:H:i',
        ]);

        Parking::create($validatedData);
        
        return redirect('/parkings')->with('parkings.llista');
    }

    public function returnNormal() {
        return redirect()->route('dashboard');
    }

    public function formEditar($id) {
        $parkings=Parking::find($id);

        return view("parkings.editar")->with('parkings', $parkings);
    }

    public function editar(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'ciutat' => 'required|string|max:255',
            'capacitat' => 'required|integer',
            'longitud' => 'required|numeric',
            'latitud' => 'required|numeric',
            'horaObertura' => 'required|date_format:H:i',
            'horaTancament' => 'required|date_format:H:i|after:horaObertura',
        ]);

        $parking = Parking::find($id);
        if (!$parking) {
            return redirect('/parkings')->with('error', 'El parking no existeix.');
        }
        $parking->update($validatedData);
        return redirect('/parkings');
    }

    public function eliminar($id){

        $parking = Parking::findOrFail($id);

        $parking->delete();

        return redirect()->route('parkings.llista');
    }
}
