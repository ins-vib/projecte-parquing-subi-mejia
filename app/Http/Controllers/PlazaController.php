<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Zona;
use App\Models\Plaza;

class PlazaController extends Controller
{
    //

    public function llista() {
        $plaçes = Plaza::with('parking')->get();
        return view('plaza.llista')->with('plaçes', $plaçes);
    }
}
