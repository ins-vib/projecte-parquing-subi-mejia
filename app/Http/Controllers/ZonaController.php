<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZonaController extends Controller
{
    //
    
    public function llista() {
        return view('zona.llista');
    }
}
