<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plaza extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'tipus', 
        'estat', 
        'zona_id'
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

}
