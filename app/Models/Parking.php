<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    public function zonas() {
        return $this->hasMany(Zona::class);
    }

    public function tipus(){
        return $this->belongsTo(Tipus::class);
    }

    protected $fillable = [
        'name',
        'address',
        'ciutat',
        'capacitat',
        'plaçes_ocupades',
        'longitud',
        'latitud',
        'horaObertura',
        'horaTancament',
        'num_plantes',
        'tipus_id',
    ];
}
