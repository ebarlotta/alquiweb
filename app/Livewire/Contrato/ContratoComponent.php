<?php

namespace App\Livewire\Contrato;

use App\Models\alqui_actualizacion;
use App\Models\alqui_ajuste;
use App\Models\alqui_contrato;
use App\Models\alqui_garante;
use App\Models\alqui_inquilino;
use App\Models\alqui_moneda;
use App\Models\alqui_propietarios;
use App\Models\persona_fisica;
use App\Models\persona_juridica;
use Livewire\Component;

// use Livewire\WithPagination;


class ContratoComponent extends Component
{
    // use WithPagination;

    public $contrato_id, $bien_id, $fechainicio, $fechafin, $cuotas=12,$duracion=1;
    public $monedas, $actualizaciones, $tipoajustes;

    public $intereses_punitorios_id=1, $gastos_administrativos=1, $actualizacion_id=1, $cant_meses, $html;

    protected $inquilinos_filtrados_fisica, $inquilinos_filtrados_juridica, $propietarios_filtrados_fisica, $propietarios_filtrados_juridica, $search;

    public $inquilinos_filtrados_fisica_id,$inquilinos_filtrados_juridica_id,$propietarios_filtrados_fisica_id,$propietarios_filtrados_juridica_id, $lugar_pago_inquilino=1;
    public $bien_type=1, $periodos_observaciones='', $detalles_administra='', $detalles_lugar_pago, $detalles_cartera='', $estado=false, $actualizaciones_id, $tipoajustes_id;
    public $incluir_mora_graficos=true, $c_general_por_diario, $c_general_dia_inicio, $c_general_dias_gracia,$c_general_porcentaje;
    public $c_part_por_diario, $c_part_dia_inicio, $c_part_dias_gracia, $c_part_porcentaje;
    public $porcentaje_administrativos=0, $valor_administrativos=0, $administra_alquiler_id=1, $activo, $gastos_administrativos_id=1, $inquilino_id, $propietario_id, $cobrar_administrativos_punitorios=false, $reintegrar_punitorios=false, $moneda_id, $ajuste_id, $admin_porc, $admin_monto, $seguro_id=3, $vencimiento, $seguro_observaciones;

    public $propietario_text, $inquilino_text, $garante_text, $buscar, $listado_fisicas, $listado_juridicas;
    public $garantes, $garantes_ids;

    public function mount() { $this->fechainicio = date_create()->format('Y-m-d'); }

    public function render()
    {

        $this->bien_id = 1;

        $this->Cargarlistados();
        $this->monedas = alqui_moneda::all();
        $this->actualizaciones = alqui_actualizacion::all();
        $this->tipoajustes = alqui_ajuste::all();
        $this->CambiarFechaInicio();
        $this->CambiarActualizacion();
        return view('livewire.contrato.contrato-component',['inquilinos_filtrados_fisica'=>$this->inquilinos_filtrados_fisica,'inquilinos_filtrados_juridica'=>$this->inquilinos_filtrados_juridica,'propietarios_filtrados_fisica'=>$this->propietarios_filtrados_fisica,'propietarios_filtrados_juridica'=>$this->propietarios_filtrados_juridica])->extends('adminlte::page');
        // return view('livewire.contrato.contrato-component',['inquilinos_filtrados_fisica'=>$this->inquilinos_filtrados_fisica,'inquilinos_filtrados_juridica'=>$this->inquilinos_filtrados_juridica,'propietarios_filtrados_fisica'=>$this->propietarios_filtrados_fisica,'propietarios_filtrados_juridica'=>$this->propietarios_filtrados_juridica])->extends('adminlte::page');
    }

    public function CambiarCuotas() { $this->cuotas = $this->duracion * 12; $this->CambiarActualizacion(); }
    public function CambiarFechaInicio() { $this->fechafin = date("Y-m-d", strtotime($this->fechainicio . "+ ".$this->duracion." year")); }
    public function CambiarIntereses() { $this->intereses_punitorios_id = $this->intereses_punitorios_id; }
    public function CambiarAdministrativos() { 
        $this->gastos_administrativos = $this->gastos_administrativos; 
        if($this->gastos_administrativos==2) { $this->porcentaje_administrativos = 0; } else { $this->valor_administrativos = 0; }
    }

    public function CambiarActualizacion() { 
        $this->actualizacion_id = $this->actualizacion_id; 
        $this->cant_meses = alqui_actualizacion::find($this->actualizacion_id)->cantmeses; $html1='';
        $a = 1;
        $fecha_inicial = $this->fechainicio; 
        // $fecha_final = strtotime($fecha_inicial . "+ ".$this->cant_meses." months");
        $fecha_final = date("Y-m-d", strtotime($fecha_inicial . "+ ".$this->cant_meses." months"));
        for($i=1; $i<$this->cuotas/$this->cant_meses + 1; $i++) {
            
            $html1=$html1.'<tr><td style="text-align: center;">Cuota '.$a.' <br><label style="font-size: 0.7rem">'.substr($fecha_inicial,8,2).'-'.substr($fecha_inicial,5,2).'-'.substr($fecha_inicial,0,4).'</label></td>
                            <td style="text-align: center;">Cuota '. $i*$this->cant_meses. '<br><label style="font-size: 0.7rem">'.substr($fecha_final,8,2).'-'.substr($fecha_final,5,2).'-'.substr($fecha_final,0,4).'</label></td>
                            <td style="text-align: center;">
                                <input type="number" size="6"><br>
                                <label style="font-size: 0.8rem">Valor Actual</label>
                            </td></tr>';
            $a = $i*$this->cant_meses+1;

            $fecha_inicial = date("Y-m-d", strtotime($fecha_final . "+ 1 days")); 
            $fecha_final = date("Y-m-d", strtotime($fecha_inicial . "+ ".$this->cant_meses." months"));
        }
        $this->html = $html1;
        // dd($this->$html);
    }

    public function Cargarlistados(){

        $this->inquilinos_filtrados_fisica = alqui_inquilino::join('persona_fisicas','alqui_inquilinos.persona_id','persona_fisicas.id')
        ->join('domicilios','persona_fisicas.domicilio_id','domicilios.id')
        ->join('ivas','persona_fisicas.iva_id','ivas.id')
        ->join('provincias','domicilios.provincia_id','provincias.id')
        ->join('localidads','domicilios.localidad_id','localidads.id')
        ->where('alqui_inquilinos.persona_type','=','fisica')
        ->where('persona_fisicas.activo','=',true)
        ->where('persona_fisicas.nombres','like',  '%' . $this->search . '%')
        ->paginate(5);
        // dd($this->   inquilinos_filtrados_fisica);
        $this->inquilinos_filtrados_juridica = alqui_inquilino::join('persona_juridicas','alqui_inquilinos.persona_id','persona_juridicas.id')
        ->join('domicilios','persona_juridicas.domicilio_id','domicilios.id')
        ->join('ivas','persona_juridicas.iva_id','ivas.id')
        ->join('provincias','domicilios.provincia_id','provincias.id')
        ->join('localidads','domicilios.localidad_id','localidads.id')
        ->where('alqui_inquilinos.persona_type','=','juridica')
        ->where('persona_juridicas.activo','=',true)
        ->where('persona_juridicas.razonsocial','like',  '%' . $this->search . '%')
        ->paginate(5);

        $this->propietarios_filtrados_fisica = alqui_propietarios::join('persona_fisicas','alqui_propietarios.persona_id','persona_fisicas.id')
        ->join('domicilios','persona_fisicas.domicilio_id','domicilios.id')
        ->join('ivas','persona_fisicas.iva_id','ivas.id')
        ->join('provincias','domicilios.provincia_id','provincias.id')
        ->join('localidads','domicilios.localidad_id','localidads.id')
        ->where('alqui_propietarios.persona_type','=','fisica')
        ->where('persona_fisicas.activo','=',true)
        ->where('persona_fisicas.nombres','like',  '%' . $this->search . '%')
        ->paginate(5);
        
        $this->propietarios_filtrados_juridica = alqui_propietarios::join('persona_juridicas','alqui_propietarios.persona_id','persona_juridicas.id')
        ->join('domicilios','persona_juridicas.domicilio_id','domicilios.id')
        ->join('ivas','persona_juridicas.iva_id','ivas.id')
        ->join('provincias','domicilios.provincia_id','provincias.id')
        ->join('localidads','domicilios.localidad_id','localidads.id')
        ->where('alqui_propietarios.persona_type','=','juridica')
        ->where('persona_juridicas.activo','=',true)
        ->where('persona_juridicas.razonsocial','like',  '%' . $this->search . '%')
        ->paginate(5);
    }

    public function store() {

        // dd($this->c_general_por_diario);

        $this->tipoajustes_id = 22;
        // 'inquilinos_filtrados_fisica_id'=>$this->inquilinos_filtrados_fisica_id,
        // 'inquilinos_filtrados_juridica_id'=>$this->inquilinos_filtrados_juridica_id,
        // 'propietarios_filtrados_fisica_id'=>$this->propietarios_filtrados_fisica_id,
        // 'propietarios_filtrados_juridica_id'=>$this->propietarios_filtrados_juridica_id,
        // if($this->intereses_punitorios_id==1) {
        //     $porcentaje_diario = $this->c_general_por_diario;
        //     $dia_inicio = $this->c_general_dia_inicio;
        //     $dias_gracia = $this->c_general_dias_gracia;
        //     $base_de_calculo = $this->c_general_porcentaje;
        // } else {
        //     $porcentaje_diario= $this->c_part_por_diario;
        //     $dia_inicio= $this->c_part_dia_inicio;
        //     $dias_gracia= $this->c_part_dias_gracia;
        //     $base_de_calculo= $this->c_part_porcentaj;
        // }

        $this->validate = [
            'bien_id'=>'required',
            'duracion'=>'required',
            'cuotas'=>'required',
            'fechainicio'=>'required',
            'fechafin'=>'required',
            'moneda_id'=>'required',
            'actualizacion_id'=>'required',
            'ajuste_id'=>'required',
            'bien_type'=>'required',
            
            'inquilino_id'=>'required',    //Buscar valor
            'propietario_id'=>'required',    //Buscar valor

            'administra_alquiler_id'=>'required',
            'lugar_pago_inquilino'=>'required',
            
            'intereses_punitorios_id'=>'required',
            
            'gastos_administrativos_id'=>'required',
            'valor_administrativos'=>'required',
            'porcentaje_administrativos'=>'required',

            'cant_meses'=>'required',            
            'ajuste_id'=>'required',
        
            'seguro_id'=>'required',
            'vencimiento'=>'required',
        ];
// dd($this->propietario_id."pppp");
        $a = alqui_contrato::updateOrCreate(['id' => $this->contrato_id],[
            'bien_id'=>$this->bien_id,
            'duracion'=>$this->duracion,
            'cuotas'=>$this->cuotas,
            'fechainicio'=>$this->fechainicio,
            'fechafin'=>$this->fechafin,
            'periodos_observaciones'=>$this->periodos_observaciones,
            'moneda_id'=>$this->moneda_id,
            'actualizacion_id'=>1, //$this->actualizaciones_id,
            'ajuste_id'=>$this->tipoajustes_id,
            'bien_type'=>$this->bien_type,
            'inquilino_id'=>$this->inquilino_id, //1, //$this->inquilino_id,    //Buscar valor
            'propietario_id'=>$this->propietario_id, //$this->propietario_id,    //Buscar valor
            'activo'=>$this->activo,
            'administra_alquiler_id'=>$this->administra_alquiler_id,
            'lugar_pago_inquilino'=>$this->lugar_pago_inquilino,
            'detalles_cartera'=>$this->detalles_cartera,
            'incluir_mora_graficos' => $this->incluir_mora_graficos,
            'intereses_punitorios_id'=>$this->intereses_punitorios_id,

            'porcentaje_diario' => $this->c_general_por_diario,
            'dia_inicio' => $this->c_general_dia_inicio,
            'dias_gracia' => $this->c_general_dias_gracia,
            'base_de_calculo' => $this->c_general_porcentaje,
                
            // 'porcentaje_diario'=>$porcentaje_diario,
            // 'dia_inicio'=>$dia_inicio,
            // 'dias_gracia'=>$dias_gracia,
            // 'base_de_calculo'=>$base_de_calculo,   

            'reintegrar_punitorios' => $this->reintegrar_punitorios,
            'cobrar_administrativos_punitorios' => $this->cobrar_administrativos_punitorios,
            'gastos_administrativos_id'=>$this->gastos_administrativos_id,
            'valor_administrativos'=>$this->valor_administrativos,
            'porcentaje_administrativos'=>$this->porcentaje_administrativos,
            'cant_meses'=>$this->cant_meses,            
            'ajuste_id'=>$this->ajuste_id,        
            'seguro_id'=>$this->seguro_id,
            'vencimiento'=>$this->vencimiento,
            'seguro_observaciones'=>$this->seguro_observaciones,
            'activo' => true,

        ]);

        session()->flash('mensaje', 'Se guardó el contrato.');

        // 'bien_id'=>$this->bien_id,C
    }

    public function CargarListado($quien) {
        $this->buscar =$quien;
        switch ($quien) {
            case 'Propietarios'; 
                $this->listado_fisicas = alqui_propietarios::leftjoin('persona_fisicas','persona_fisicas.id','alqui_propietarios.persona_id')
                ->where('persona_fisicas.activo',true)
                ->where('persona_type','fisica')
                ->get();
                $this->listado_juridicas = alqui_propietarios::leftjoin('persona_juridicas','persona_juridicas.id','alqui_propietarios.persona_id')
                ->where('persona_juridicas.activo',true)
                ->where('persona_type','juridica')
                ->get(); 
                // dd($this->listado_fisicas); 
                break;
            case 'Inquilinos'; 
                $this->listado_fisicas = alqui_inquilino::leftjoin('persona_fisicas','persona_fisicas.id','alqui_inquilinos.persona_id')
                ->where('persona_fisicas.activo',true)
                ->where('persona_type','fisica')
                ->get();
                $this->listado_juridicas = alqui_inquilino::leftjoin('persona_juridicas','persona_juridicas.id','alqui_inquilinos.persona_id')
                ->where('persona_juridicas.activo',true)
                ->where('persona_type','juridica')
                ->get(); 
                break;
            case 'Garantes'; 
                $this->listado_fisicas = alqui_garante::leftjoin('persona_fisicas','persona_fisicas.id','alqui_garantes.persona_id')
                ->where('persona_fisicas.activo',true)
                ->where('persona_type','fisica')
                ->get();
                $this->listado_juridicas = alqui_garante::leftjoin('persona_juridicas','persona_juridicas.id','alqui_garantes.persona_id')
                ->where('persona_juridicas.activo',true)
                ->where('persona_type','juridica')
                ->get(); 
                break;
        }
    }

    public function Elegir($tipo, $id) {
        if($tipo=='fisica') {
            switch ($this->buscar) {
                case 'Propietarios':
                    $a = persona_fisica::find($id); $this->propietario_text = $a->apellidos.', '.$a->nombres; $this->propietario_id = $a->id; break;
                case 'Inquilinos':
                    $a = persona_fisica::find($id); $this->inquilino_text = $a->apellidos.', '.$a->nombres; $this->inquilino_id = $a->id; break;
                case 'Garantes':
                    $a = persona_fisica::find($id); $this->garantes[$a->id] = array($a->apellidos.', '.$a->nombres, (string) $a->id); break;
            }
        } else {
            switch ($this->buscar) {
                case 'Propietarios':
                    $a = persona_juridica::find($id); $this->propietario_text = $a->razonsocial;  $this->propietario_id = $a->id; break;
                case 'Inquilinos':
                    $a = persona_juridica::find($id); $this->inquilino_text = $a->razonsocial; $this->inquilino_id= $a->id; break;
                case 'Garantes':
                    $a = persona_juridica::find($id); $this->garantes[$a->id] = array($a->razonsocial, (string) $a->id); break;
            }
        }
        // dd($a->id);
    }

    public function EliminarGarante($id) {
        unset($this->garantes[$id]);
    }
}
