<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    public function parking(){
        return $this->belongsTo(Parking::class);
    }

    public function plazas() {
        return $this->hasMany(Plaza::class);
    }

    protected $fillable = [
        'parking_id',
        'nom',
        'capacitatTotal',
        'estat',
    ];
}
