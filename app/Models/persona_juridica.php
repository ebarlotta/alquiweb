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
        'telefono_id',
        'emails_id',
        'observaciones',
        'activo',
        'iva_id',
        'domicilio_id',
    ];
}
