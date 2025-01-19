<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotxe extends Model
{
    use HasFactory;


    protected $fillable = [
        'matricula',
        'marca_cotxe',
        'model_cotxe'
    ];
    public function plazas() {
        return $this->hasMany(Plaza::class);
    }

    public function users() {
        return $this->belongsTo(User::class);
    }
}
