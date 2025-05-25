<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaccio;
use App\Models\Plaza;
use Carbon\Carbon;

class TransaccioController extends Controller
{
    //
    public function llista()
    {
        $transaccions = Transaccio::with(['plaza', 'cotxe'])->latest()->get();
        return view('transaccions.llista')->with('transaccions', $transaccions);
    }
}
