<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plaza extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'tipus_id', 
        'estat', 
        'zona_id',
        'coordenada_x',
        'coordenada_y',
    ];

    public function zona() {
        return $this->belongsTo(Zona::class);
    }

    public function parking() {
        return $this->belongsTo(Parking::class);
    }

    public function cotxe() {
        return $this->belongsTo(Cotxe::class);
    }

    public function tipusplaça()
    {
        return $this->belongsTo(Tipusplaçes::class, 'tipus_id');
    }

}
