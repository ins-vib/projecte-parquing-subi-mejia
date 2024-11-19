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

}
