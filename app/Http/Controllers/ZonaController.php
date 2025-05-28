<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;
use App\Models\Parking;
use App\Models\Plaza;
use App\Models\Tipusplaçes;

class ZonaController extends Controller
{
    //
    
    public function llista() {
        $plantes = Zona::with('parking')->get();
        $plantes = Zona::Paginate(15);
        return view('zona.llista',compact('plantes'))->with('plantes', $plantes);
    }

    public function formAfegir(){
        $parkings = Parking::all();
        $tipusPlaces = Tipusplaçes::all();
        return view('zona.afegir', compact('parkings', 'tipusPlaces'));
    }

    public function afegir(Request $request) {
        $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'parking_id' => 'required|exists:parkings,id',
        'capacitatTotal' => 'required|integer|min:1',
        'quantitat' => 'required|array',
        'quantitat.*' => 'nullable|integer|min:0',
        ]);

        $sumaQuantitats = 0;
        foreach ($validatedData['quantitat'] as $valor) {
            $sumaQuantitats += is_numeric($valor) ? (int)$valor : 0;
        }

        if ($sumaQuantitats !== (int)$validatedData['capacitatTotal']) {
            return redirect()->back()->withInput()->with('error', 'La suma de les quantitats de places ha de ser igual a la capacitat total.');
        }

        $zona = Zona::create([
            'nom' => $validatedData['nom'],
            'parking_id' => $validatedData['parking_id'],
            'capacitatTotal' => $validatedData['capacitatTotal'],
            'estat' => $request->has('estat') ? 1 : 0,
        ]);

        $totalPlaces = 0;
        foreach ($validatedData['quantitat'] as $tipusId => $quantitat) {
            if ($quantitat > 0) {
                $totalPlaces += $quantitat;

                for ($j = 0; $j < $quantitat; $j++) {
                    Plaza::create([
                        'zona_id' => $zona->id,
                        'tipus_id' => $tipusId,
                        'estat' => 1,
                        'numero' => $j + 1,
                        'bloquejat' => 0,
                    ]);
                }
            }
        }

        if ($totalPlaces > $validatedData['capacitatTotal']) {
            return redirect()->back()->with('error', 'El total de places excedeix la capacitat total de la zona')->withInput();
        }

        $parking = Parking::findOrFail($validatedData['parking_id']);
        $parking->capacitat += $totalPlaces;
        $parking->save();

        return redirect()->route('zona.llista')->with('success', 'Zona creada correctament amb les seves places');
    }

    public function formEditar($id) {
        $zona = Zona::findOrFail($id);
        $parkings = Parking::all();
        $tipusPlaces = Tipusplaçes::all();
        $placesPerTipus = Plaza::where('zona_id', $id)->select('tipus_id', \DB::raw('count(*) as total'))->groupBy('tipus_id')->get()->keyBy('tipus_id');
            
        return view('zona.editar', compact('zona', 'parkings', 'tipusPlaces', 'placesPerTipus'));
    }

    public function editar(Request $request, $id) {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'parking_id' => 'required|exists:parkings,id',
            'capacitatTotal' => 'required|integer|min:1',
            'estat' => 'boolean',
            'tipus_vehicle' => 'required|array',
            'quantitat' => 'required|array',
            'tipus_vehicle.*' => 'required|exists:tipusplaçes,id',
            'quantitat.*' => 'required|integer|min:0',
        ]);

        $sumaQuantitats = 0;
        foreach ($validatedData['quantitat'] as $valor) {
            $sumaQuantitats += is_numeric($valor) ? (int)$valor : 0;
        }

        if ($sumaQuantitats !== (int)$validatedData['capacitatTotal']) {
            return redirect()->back()->withInput()->with('error', 'La suma de les quantitats de places ha de ser igual a la capacitat total.');
        }

        $zona = Zona::findOrFail($id);
        $idParkingVell = $zona->parking_id;
        $plaçesAbans = Plaza::where('zona_id', $id)->count();
        
        $zona->update([
            'nom' => $validatedData['nom'],
            'parking_id' => $validatedData['parking_id'],
            'capacitatTotal' => $validatedData['capacitatTotal'],
            'estat' => $request->has('estat') ? 1 : 0,
        ]);

        $plaçesActuals = Plaza::where('zona_id', $id)->select('tipus_id', \DB::raw('count(*) as total'))->groupBy('tipus_id')->get()->keyBy('tipus_id');

        $totalPlaces = 0;
        for ($i = 0; $i < count($validatedData['tipus_vehicle']); $i++) {
            $tipusId = $validatedData['tipus_vehicle'][$i];
            $quantitat = $validatedData['quantitat'][$i];
            $totalPlaces += $quantitat;
            
            $quantitatActual = isset($plaçesActuals[$tipusId]) ? $plaçesActuals[$tipusId]->total : 0;
            
            if ($quantitat > $quantitatActual) {
                $afegir = $quantitat - $quantitatActual;
                $ultim = Plaza::where('zona_id', $id)->max('numero') ?? 0;
                
                for ($j = 0; $j < $afegir; $j++) {
                    Plaza::create([
                        'zona_id' => $zona->id,
                        'tipus_id' => $tipusId,
                        'estat' => 1, 
                        'numero' => $ultim + $j + 1,
                        'bloquejat' => 0, 
                    ]);
                }
            } elseif ($quantitat < $quantitatActual) {
                $eliminar = $quantitatActual - $quantitat;
                $placesEliminar = Plaza::where('zona_id', $id)
                    ->where('tipus_id', $tipusId)
                    ->where('estat', 1) 
                    ->orderByDesc('numero')
                    ->limit($eliminar)
                    ->get();
                
                if (count($placesEliminar) < $eliminar) {
                    return redirect()->back()->with('error', 'No es poden eliminar places ocupades')->withInput();
                }
                
                foreach ($placesEliminar as $place) {
                    $place->delete();
                }
            }
            
        }

        if ($totalPlaces > $validatedData['capacitatTotal']) {
            return redirect()->back()->with('error', 'El total de places excedeix la capacitat total de la zona')->withInput();
        }

        $plaçesNoves = Plaza::where('zona_id', $id)->count();
        $diferenciadePlaçes = $plaçesNoves - $plaçesAbans;
        
        if ($idParkingVell == $validatedData['parking_id']) {
            $parking = Parking::findOrFail($validatedData['parking_id']);
            $parking->capacitat += $diferenciadePlaçes;
            $parking->save();
        } else {
            $parkingVell = Parking::findOrFail($idParkingVell);
            $parkingVell->capacitat -= $plaçesAbans;
            $parkingVell->save();
            
            $parkingNou = Parking::findOrFail($validatedData['parking_id']);
            $parkingNou->capacitat += $plaçesNoves;
            $parkingNou->save();
        }

        return redirect()->route('zona.llista')->with('success', 'Zona i places actualitzades correctament');
    }

    public function eliminar($id) {
        $zona = Zona::findOrFail($id);
        
        $plaçesOcupades = Plaza::where('zona_id', $id)->where('estat', 0) ->count();
        
        if ($plaçesOcupades > 0) {
            return redirect()->route('zona.llista')->with('error', 'No es pot eliminar la zona perquè té places ocupades');
        }
        
        $totalPlaces = Plaza::where('zona_id', $id)->count();
        $parkingId = $zona->parking_id;
        
        Plaza::where('zona_id', $id)->delete();
        
        $parking = Parking::findOrFail($parkingId);
        $parking->capacitat -= $totalPlaces;
        $parking->save();
        
        $zona->delete();
        
        return redirect()->route('zona.llista')->with('success', 'Zona i places eliminades correctament');
    }
}
