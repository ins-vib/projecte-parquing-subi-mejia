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
            'num_plantes' => 'required|integer|min:1',
        ]);

        $parking = Parking::create($validatedData);

        $numPlantes = $validatedData['num_plantes'];
        $capacitatPerPlanta = floor($validatedData['capacitat'] / $numPlantes);

        for ($i = 1; $i <= $numPlantes; $i++) {
            Zona::create([
                'parking_id' => $parking->id,
                'nom' => 'Planta ' . $i,
                'capacitatTotal' => $capacitatPerPlanta, 
                'estat' => true, 
            ]);
        }

        
        return redirect('/parkings')->with('parkings.llista');
    }

    public function returnNormal() {
        return redirect()->route('dashboard');
    }

    public function formEditar($id) {
        $parkings=Parking::find($id);

        return view("parkings.editar")->with('parkings', $parkings);
    }

    public function editar(Request $request, $id) {

        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'ciutat' => 'required',
            'capacitat' => 'required',
            'longitud' => 'required',
            'latitud' => 'required',
            'horaObertura' => 'required',
            'horaTancament' => 'required',
        ]);

        return redirect('/parkings');
    }

    public function eliminar($id){
        Zona::where('parking_id', $id)->delete();

        $parking = Parking::findOrFail($id);

        $parking->delete();

        return redirect()->route('parkings.llista');
    }
}
