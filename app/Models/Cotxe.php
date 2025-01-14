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
}
