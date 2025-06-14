<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Zona;
use App\Models\Plaza;
use App\Models\Cotxe;
use App\Models\Imatge;
use App\Models\Tipusplaçes;
use App\Models\Tarifa;

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
        $tarifes = Tarifa::all();
        return view("parkings.afegir")->with('tipusPlaçes', $tipusPlaçes)->with('tarifes', $tarifes);
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

        $latitudBase = $parking->latitud;
        $longitudBase = $parking->longitud;

        $numPlantes = $validatedData['num_plantes'];

        $numeroPlaça = 1;
        $plaçesPerTipus = [];
        foreach ($validatedData['num_places'] as $tipus_id => $quantitatTotal) {
            $plaçesPerTipus[$tipus_id] = [
                'per_planta' => intdiv($quantitatTotal, $numPlantes),
                'restant' => $quantitatTotal % $numPlantes
            ];
        }

        $offset = 0.00002;

        for ($i = 1; $i <= $numPlantes; $i++) {
            $zona = Zona::create([
                'parking_id' => $parking->id,
                'nom' => 'Planta ' . $parking->name . ' ' . $i,
                'capacitatTotal' => 0,
                'estat' => true,
            ]);    

            $capacitatZona = 0;

            foreach ($plaçesPerTipus as $tipus_id => &$data) {
                $quantitat = $data['per_planta'];
                if ($data['restant'] > 0) {
                    $quantitat += 1;
                    $data['restant'] -= 1;
                }

                for ($j = 0; $j < $quantitat; $j++) {
                    Plaza::create([
                        'numero' => 'Numero ' . $numeroPlaça++,
                        'tipus_id' => $tipus_id,
                        'estat' => true,
                        'zona_id' => $zona->id,
                        'coordenada_x' => $longitudBase + ($numeroPlaça * $offset),
                        'coordenada_y' => $latitudBase + ($i * $offset),
                    ]);
                }

                $capacitatZona += $quantitat;
            }

            $zona->update(['capacitatTotal' => $capacitatZona]);
        }
        return redirect('/parkings')->with('parkings.llista');
    }

    public function returnNormal() {
        return redirect()->route('dashboard');
    }

    public function formEditar($id) {
        $parkings=Parking::find($id);
        $tipusPlaçes = Tipusplaçes::all();
        $tarifes = Tarifa::all();
        return view("parkings.editar")->with('parkings', $parkings)->with('tipusPlaçes', $tipusPlaçes)->with('tarifes', $tarifes);
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
            'tipus_id' => 'required',
            'num_places' => 'required',
            'tarifa_id' => 'required',
        ]);

        $sumaPlaces = array_sum($validatedData['num_places']);
        if ($sumaPlaces != $validatedData['capacitat']) {
            return back()->withErrors(['num_places' => 'La suma de les places ha de ser igual a la capacitat total.'])->withInput();
        }

        $parkings=Parking::findOrFail($id);
        $parkings->update($validatedData);

        $numPlantes = $validatedData['num_plantes'];

        Plaza::whereIn('zona_id', Zona::where('parking_id', $id)->pluck('id'))->delete();
        Zona::where('parking_id', $id)->delete();
       
        $numeroPlaça = 1;
        $plaçesPerTipus = [];
        foreach ($validatedData['num_places'] as $tipus_id => $quantitatTotal) {
            $plaçesPerTipus[$tipus_id] = [
                'per_planta' => intdiv($quantitatTotal, $numPlantes),
                'restant' => $quantitatTotal % $numPlantes
            ];
        }

        for ($i = 1; $i <= $numPlantes; $i++) {
            $zona = Zona::create([
                'parking_id' => $parkings->id,
                'nom' => 'Planta ' . $parkings->name . ' ' . $i,
                'capacitatTotal' => 0,
                'estat' => true,
            ]);    

            $capacitatZona = 0;

            foreach ($plaçesPerTipus as $tipus_id => &$data) {
                $quantitat = $data['per_planta'];
                if ($data['restant'] > 0) {
                    $quantitat += 1;
                    $data['restant'] -= 1;
                }

                for ($j = 0; $j < $quantitat; $j++) {
                    Plaza::create([
                        'numero' => 'Numero ' . $numeroPlaça++,
                        'tipus_id' => $tipus_id,
                        'estat' => true,
                        'zona_id' => $zona->id,
                    ]);
                }

                $capacitatZona += $quantitat;
            }

            $zona->update(['capacitatTotal' => $capacitatZona]);
        }

        return redirect('/parkings')->with('success', 'Parking actualitzat correctament');
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
        $cotxeId = $request->cotxe_id;
        $cotxeJaAparcat = Plaza::where('cotxe_id', $cotxeId)->where('estat', 0)->exists();
        if ($cotxeJaAparcat) {
            return redirect()->back()->withErrors(['error' => 'Aquest cotxe ja està aparcat.']);
        }
        
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