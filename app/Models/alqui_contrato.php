<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alqui_contrato extends Model
{
    use HasFactory;

    protected $fillable=[
        'duracion',
        'cuota',
        'fechainicio',
        'fechafin',
        'observaciones',
        'moneda_id',
        'actualización_id',
        'tipoajuste_id',
        'bien_type',
        'bien_id',
        'inquilino_id',
    ];
}
