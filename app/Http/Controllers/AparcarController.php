<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AparcarController extends Controller
{
    //

    public function aparcar() {
        return view('aparcar.aparcar');
    }
}
