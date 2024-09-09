<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona_fisica extends Model
{
    use HasFactory;

    protected $fillable=[
        'apellidos',
        'nombres',
        'cuil',
        'dni',
        'fechanacimiento',
        'observaciones',
        'emails_id',
        'activo',
        'telefono_id',
        'iva_id',
        'domicilio_id',
    ];
}
