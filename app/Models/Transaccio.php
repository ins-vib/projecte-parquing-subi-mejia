<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccio extends Model
{
    use HasFactory;
    protected $table = 'transaccions';

    protected $fillable = [
        'plaza_id',
        'cotxe_id',
        'hora_entrada',
        'hora_sortida',
        'import',
    ];
    protected $casts = [
        'hora_entrada' => 'datetime',
        'hora_sortida' => 'datetime',
    ];

    public function plaza() {
        return $this->belongsTo(Plaza::class);
    }

    public function cotxe() {
        return $this->belongsTo(Cotxe::class);
    }
}
