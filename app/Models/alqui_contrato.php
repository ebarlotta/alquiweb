<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use LDAP\Result;

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
        'valores',
        'activo',
    ];

    public function inquilino() {
        $a = alqui_inquilino::where('persona_id','=',$this->inquilino_id)->get();

        if($a[0]->persona_type == 'fisica') { 
            $b = persona_fisica::find($a[0]->persona_id);
            $resul = $b->apellidos.', ' .$b->nombres;
        } else {
            $b = persona_juridica::find($a->persona_id);
            $resul = $b->razonsocial;
        }
        return $resul;
    }

    public function propietario() {
        $a = alqui_propietarios::where('persona_id','=',$this->propietario_id)->get();
        
        if($a[0]->persona_type == 'fisica') { 
            $b = persona_fisica::find($a[0]->persona_id);
            $resul = $b->apellidos.', ' .$b->nombres;
        } else {
            $b = persona_juridica::find($a->persona_id);
            $resul = $b->razonsocial;
        }
        return $resul;
    }

    public function garantes($id) {
        $pf = alqui_rel_contrato_garante::join('persona_fisicas','persona_fisicas.id','alqui_rel_contrato_garantes.garante_id')
        ->where('contrato_id','=',$id)
        ->where('persona_type','=','fisica')
        ->where('alqui_rel_contrato_garantes.activo','=',true)
        ->get();
        $pj = alqui_rel_contrato_garante::join('persona_juridicas','persona_juridicas.id','alqui_rel_contrato_garantes.garante_id')
        ->where('contrato_id','=',$id)
        ->where('persona_type','=','juridica')
        ->where('alqui_rel_contrato_garantes.activo','=',true)
        ->get();
        // $a = alqui_rel_contrato_garante::where('contrato_id','=',$id)->get();
        // dd($a);
        $html = "<table>";
        if(count($pf)) {
            foreach($pf as $garante) {
                $html = $html . "<tr><td><label style=\"border-radius: 10px;background-color: lightblue;padding: 2px 10px 2px 10px;\">".$garante->apellidos.', '. $garante->nombres . "<label></td></tr>";
            }
        }
        if(count($pj)) {
            foreach($pj as $garante) {
                $html = $html . "<tr><td><label style=\"border-radius: 10px;background-color: lightblue;padding: 2px 10px 2px 10px;\">".$garante->razonsocial . "<label></td></tr>";
            }
        }
        $html = $html . "</table>";
        
        // if($id == 14 ) dd($html);
        // dd($html);
        return $html;
    }
}
