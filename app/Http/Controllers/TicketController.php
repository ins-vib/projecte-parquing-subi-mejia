<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarifa;
use App\Models\Plaza;

class TicketController extends Controller
{
    //

    public function generarTicket($plaça_id)
    {
        $plaça = Plaza::findOrFail($plaça_id);
        $horaInici = $plaça->entrada_timestamp;
        $horaFinal = time();
        $tempsAparcat = $horaFinal - $horaInici;
        $horesAparcat = $tempsAparcat / 3600;
        
        $tarifa = Tarifa::first();
        $preuTotal = $horesAparcat * $tarifa->preu;
        
        return view('tickets.ticket', [
            'plaça' => $plaça,
            'horaInici' => date('d/m/Y H:i:s', $horaInici),
            'horaFinal' => date('d/m/Y H:i:s', $horaFinal),
            'horesAparcat' => $horesAparcat,
            'preuTotal' => $preuTotal
        ]);
    }
}
