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
        'email_id',
        'telefono',
        'whatsapp',
        'iva_id',
        'domicilio_id',
        'activo',
    ];
}
