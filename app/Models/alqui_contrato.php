<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alqui_contrato extends Model
{
    use HasFactory;

    protected $fillable=[
        'duracion',
        'cuotas',
        'fechainicio',
        'fechafin',
        'periodos_observaciones',
        'moneda_id',
        'actualizacion_id',
        'ajuste_id',
        'bien_type',
        'inquilino_id',
        'propietario_id',
        'activo',
        'administra_alquiler_id',
        'lugar_pago_inquilino',
        'detalles_cartera',
        'incluir_mora_graficos',
        'intereses_punitorios_id',
        'porcentaje_diario',
        'dia_inicio',
        'dias_gracia',
        'base_de_calculo',
        'reintegrar_punitorios',
        'cobrar_administrativos_punitorios',
        'gastos_administrativos_id',
        'valor_administrativos',
        'porcentaje_administrativos',
        'cant_meses',
        'ajuste_id',
        'seguro_id',
        'vencimiento',
        'seguro_observaciones',
        'bien_id',
    ];
}
