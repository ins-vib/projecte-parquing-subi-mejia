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

    protected $fillable = [
        'name',
        'address',
        'ciutat',
        'capacitat',
        'longitud',
        'latitud',
        'horaObertura',
        'horaTancament',
    ];
}
