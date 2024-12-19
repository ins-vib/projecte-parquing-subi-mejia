<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plaza extends Model
{
    use HasFactory;

    protected $fillable = ['tipus', 'estat', 'zona_id'];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }
}
