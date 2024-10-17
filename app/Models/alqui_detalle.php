<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alqui_detalle extends Model
{
    use HasFactory;

    protected $fillable=[
        'fecha_vencimiento',
        'detalle',
        'monto',
        'quien',
        'mostrar_en_conceptos',
        'mes',
        'anio',
        'cuota',
        'contrato_id',
        'vistaprevia',
    ];
}
