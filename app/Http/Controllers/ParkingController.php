<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Zona;
use App\Models\Plaza;
use App\Models\Cotxe;
use App\Models\Imatge;
use App\Models\Tipusplaçes;

use Illuminate\Support\Facades\DB;

class ParkingController extends Controller
{
    //

    public function llista() {
        $parkings = Parking::with('tarifa')->paginate(10);
        return view("parkings.llista")->with('parkings',$parkings);
    }

    public function informacio($id) {
        $zonas=Zona::where('parking_id', $id)->get();
        $parkings=Parking::find($id);
        return view("parkings.informacio")->with('parkings', $parkings)->with('zonas', $zonas);
    }

    public function formAfegir() {
        $tipusPlaçes = Tipusplaçes::all(); 
        return view("parkings.afegir")->with('tipusPlaçes', $tipusPlaçes);
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
            'tarifa_id' => 'required',
            'tipus_id' => 'required|exists:tipusparking,id', 
            'num_places' => 'required|array', 
        ]);

        $sumaPlaces = array_sum($validatedData['num_places']);
        if ($sumaPlaces != $validatedData['capacitat']) {
            return back()->withErrors(['num_places' => 'La suma de les places ha de ser igual a la capacitat total.'])->withInput();
        }

        $parking = Parking::create($validatedData);

        $numPlantes = $validatedData['num_plantes'];
        $capacitatPerPlanta = floor($validatedData['capacitat'] / $numPlantes);

        $numeroPlaça = 1;
        for ($i = 1; $i <= $numPlantes; $i++) {
            $zona = Zona::create([
                'parking_id' => $parking->id,
                'nom' => 'Planta ' . $parking->name . ' ' . $i,
                'capacitatTotal' => $capacitatPerPlanta,
                'estat' => true,
            ]);    

            foreach ($validatedData['num_places'] as $tipus_id => $quantitat) {
                for ($j = 0; $j < $quantitat / $numPlantes; $j++) {
                    Plaza::create([
                        'numero' => 'Numero ' . $numeroPlaça++,
                        'tipus_id' => $tipus_id,
                        'estat' => true,
                        'zona_id' => $zona->id,
                    ]);
                }
            }    
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
            'num_plantes' => 'required',
        ]);

        $parkings=Parking::find($id);

        $parkings->name = $validatedData['name'];
        $parkings->address = $validatedData['address'];
        $parkings->ciutat = $validatedData['ciutat'];
        $parkings->capacitat = $validatedData['capacitat'];
        $parkings->longitud = $validatedData['longitud'];
        $parkings->latitud = $validatedData['latitud'];
        $parkings->horaObertura = $validatedData['horaObertura'];
        $parkings->horaTancament = $validatedData['horaTancament'];

        $parkings->save();

        $numPlantes = $validatedData['num_plantes'];
        $capacitatPerPlanta = floor($validatedData['capacitat'] / $numPlantes);

        $zonesExistents = $parkings->zonas;

        if ($zonesExistents->count() > $numPlantes) {
            $zonesExistents->slice($numPlantes)->each(function($zona) {
                $zona->delete();
            });
        }

        foreach ($zonesExistents as $index => $zona) {
            if ($index < $numPlantes) {
                $zona->capacitatTotal = $capacitatPerPlanta;
                $zona->save();
            }
        }

        for ($i = $zonesExistents->count(); $i < $numPlantes; $i++) {
            Zona::create([
                'parking_id' => $parkings->id,
                'nom' => 'Planta ' . ($i + 1),
                'capacitatTotal' => $capacitatPerPlanta,
                'estat' => true,
            ]);
    }

        return redirect('/parkings');
    }

    public function eliminar($id){
        Plaza::whereIn('zona_id', Zona::where('parking_id', $id)->pluck('id'))->delete();
        Zona::where('parking_id', $id)->delete();

        $parking = Parking::findOrFail($id);

        $parking->delete();

        return redirect()->route('parkings.llista');
    }






    //GESTIONS DE OPERADOR
    public function llistaOperador() {
        $parkings = Parking::all();
        return view('operador.llistaparkings')->with('parkings', $parkings);
    }

    public function aparcarCotxesOperador($id, Request $request) {
        $buscar = request('buscar');        
        $parking = Parking::findOrFail($id);

        $cotxes = Cotxe::with('user')
        ->when($buscar, function($query) use ($buscar) {
            return $query->where(function($q) use ($buscar) {
                $q->where('matricula', 'like', "%{$buscar}%")
                  ->orWhere('marca_cotxe', 'like', "%{$buscar}%")
                  ->orWhere('model_cotxe', 'like', "%{$buscar}%");
            });
        })
        ->paginate(15);

        return view('operador.llistacotxes')->with('cotxes', $cotxes)->with('buscar', $buscar)->with('parking', $parking);
    }

    public function aparcarParkingPlantesOperador($id, $cotxe_id) {
        $parking = Parking::findOrFail($id);
        $plantes = Zona::where('parking_id', $id)->get();
        $cotxe = Cotxe::findOrFail($cotxe_id);
        return view('operador.plantes')->with('parking', $parking)->with('plantes', $plantes)->with('cotxe', $cotxe);
    }

    public function aparcarParkingPlazasOperador($parking_id, $cotxe_id, $id) {
        $parking = Parking::findOrFail($parking_id);
        $planta = Zona::findOrFail($id);
        $plaçes = Plaza::where('zona_id', $id)->get();
        $cotxe = Cotxe::findOrFail($cotxe_id);
        return view('operador.plaçes')->with('planta', $planta)->with('plaçes', $plaçes)->with('parking', $parking)->with('cotxe', $cotxe);
    }

    public function enviaraparcarParkingPlazasOperador($id, Request $request) {
        $plaça = Plaza::findOrFail($id); 
        $parking = Parking::findOrFail($plaça->zona->parking_id);
        $parking->plaçes_ocupades = $parking->plaçes_ocupades + 1;

        $plaça->estat = 0; 
        $plaça->cotxe_id = $request->cotxe_id;
        $plaça->entrada_timestamp = time();
        $plaça->save();    
        $parking->save();
        return redirect()->back();
    }

    public function desaparcarOperador($id) {
        $plaça = Plaza::findOrFail($id); 
        $parking = Parking::findOrFail($plaça->zona->parking_id);
        $parking->plaçes_ocupades = $parking->plaçes_ocupades - 1;

        $plaça->estat = 1; 
        $plaça->sortida_timestamp = time();
        $plaça->save();    
        $parking->save();
        return redirect()->route('tickets.ticket', $id);
    }


    //Imatges
    public function mostrarImatges($id) {
        $parking = Parking::findOrFail($id);
        $imatges = Imatge::where('parking_id', $id)->get();
        return view('parkings.mostrarImatges', compact('parking', 'imatges'));
    }    

    public function pujarImatges(Request $request) {
        $request->validate([
            'parking_id' => 'required|exists:parkings,id',
            'imatge' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $path = $request->file('imatge')->store('imatges', 'public');
    
        $imatge = new Imatge();
        $imatge->parking_id = $request->parking_id;
        $imatge->path = $path;
        $imatge->save();
    
        return redirect()->back()->with('success', 'Imatge pujada correctament!');
    }
}