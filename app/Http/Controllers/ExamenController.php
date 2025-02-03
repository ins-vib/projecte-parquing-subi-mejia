<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;

class ExamenController extends Controller
{
    //

    public function llista() {
        $parkings = Parking::all();
        return view('examen.llistat')->with('parkings', $parkings);
    }

}
