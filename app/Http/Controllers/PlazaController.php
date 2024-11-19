<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlazaController extends Controller
{
    //

    public function llista() {
        return view('plaza.llista');
    }
}
