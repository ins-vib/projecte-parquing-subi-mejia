<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotxe;

class CotxeController extends Controller
{
    //

    public function llista() {
        $cotxes = Cotxe::all();
        return view('cotxes.llista')->with('cotxes', $cotxes);
    }

    //afegir i eliminar

    public function cotxeAfegir() {
        return view('cotxes.afegir');
    }

    public function ctoxesEnviar(Request $request) {
        
    }
}
