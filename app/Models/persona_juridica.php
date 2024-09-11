<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona_juridica extends Model
{
    use HasFactory;

    protected $fillable=[
        'razonsocial',
        'cuit',
        'telefono',
        'whatsapp',
        'email_id',
        'iva_id',
        'fechainicioact',
        'domicilio_id',
        'observaciones',
        'activo',
    ];
}
