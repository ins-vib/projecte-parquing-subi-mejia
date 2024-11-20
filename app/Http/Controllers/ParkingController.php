<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;

class ParkingController extends Controller
{
    //

    public function llista() {
        
        $parkings= Parking::all();
        return view("parkings.llista")->with('parkings',$parkings);
    }

    public function informacio($id) {
        $parkings=Parking::find($id);
        return view("parkings.informacio")->with('parkings', $parkings);
    }

}
