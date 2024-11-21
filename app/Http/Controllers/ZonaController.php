<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;

class ZonaController extends Controller
{
    //
    
    public function llista($id) {
        $zonas=Zona::find($id);
        return view('zona.llista')->with('zonas',$zonas);;
    }
}
