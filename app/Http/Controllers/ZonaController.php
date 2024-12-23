<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;
use App\Models\Parking;

class ZonaController extends Controller
{
    //
    
    public function llista() {
        $plantes = Zona::with('parking')->get();
        return view('zona.llista')->with('plantes', $plantes);
    }
}
