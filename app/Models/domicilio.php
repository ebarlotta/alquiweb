<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class domicilio extends Model
{
    use HasFactory;

    protected $fillable=[
        'calle',
        'altura',
        'depto',
        'ubicaciongps',
        'observaciones',
        'activo',
        'provincia_id',
        'localidad_id',
    ];
}
