<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imatge extends Model
{

    use HasFactory;

    protected $fillable = ['parking_id', 'path'];

    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }

}
