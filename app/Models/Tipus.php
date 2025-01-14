<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipus extends Model
{
    use HasFactory;

    public function parkings() {
        return $this->hasMany(Parking::class);
    }

    protected $fillable = [
        'tipus',
    ];
    
}
