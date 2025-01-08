<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;

class AparcarController extends Controller
{
    //

    public function aparcar() {
        $parkings = Parking::all();
        return view('aparcar.aparcar')->with('parkings', $parkings);
    }
}
