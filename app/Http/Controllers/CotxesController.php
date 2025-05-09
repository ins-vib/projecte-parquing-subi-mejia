<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotxe;
use App\Models\User;


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

    public function cotxeAfegirAdmin(Request $request) {
        $users = User::all();
        return view('cotxes.afegircotxeadmin')->with('users', $users);
    }

    public function cotxeAfegirAdminEnviar(Request $request) {
        $validatedData = $request->validate([
            'matricula' => ['required', 'regex:/^[0-9]{4}[A-Z]{3}$/'],
            'marca_cotxe' => 'required|string|max:25',
            'model_cotxe' => 'required|string|max:25',
            'user_id' => 'required|exists:users,id',
        ]);        
        $cotxe = Cotxe::Create($validatedData);
        return redirect()->route('cotxes.llista');
    }

    public function eliminar($id){
        $cotxes = Cotxe::findOrFail($id);
        $cotxes->plazas()->update(['cotxe_id' => null]);
        $cotxes->delete();
        return redirect()->route('cotxes.llista');
    }

    public function cotxeEditar($id) {
        $cotxes = Cotxe::findOrFail($id);
        $users = User::all();
        return view('cotxes.editar')->with('cotxes', $cotxes)->with('users', $users);
    }

    public function cotxeEditarEnviar($id, Request $request) {
        $validatedData = $request->validate([
            'matricula' => ['required', 'regex:/^[0-9]{4}[A-Z]{3}$/'],
            'marca_cotxe' => 'required|string|max:25',
            'model_cotxe' => 'required|string|max:25',
            'user_id' => 'required|exists:users,id',
        ]);
        $cotxe = Cotxe::findOrFail($id);
        $cotxe->update($validatedData);
        return redirect()->route('cotxes.llista');
    }
}
