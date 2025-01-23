<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    use HasFactory;

    protected $table = 'tarifa';

    public function parking() {
        return $this->hasMany(Parking::class);
    }

    protected $fillable = [
        'preu',
    ];
}
