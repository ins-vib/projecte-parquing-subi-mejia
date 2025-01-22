<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotxe;

class CotxesController extends Controller
{
    //

    public function llista() {
        $buscar = request('buscar');        
        $cotxes = Cotxe::with('user')
        ->when($buscar, function($query) use ($buscar) {
            return $query->where(function($q) use ($buscar) {
                $q->where('matricula', 'like', "%{$buscar}%")
                  ->orWhere('marca_cotxe', 'like', "%{$buscar}%")
                  ->orWhere('model_cotxe', 'like', "%{$buscar}%");
            });
        })
        ->paginate(15);
        return view('cotxes.llista')->with('cotxes', $cotxes)->with('buscar', $buscar);
    }

    public function eliminar($id){
        $cotxes = Cotxe::findOrFail($id);
        $cotxes->delete();
        return redirect()->route('cotxes.llista');
    }
}
