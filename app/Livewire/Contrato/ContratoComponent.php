<?php

namespace App\Livewire\Contrato;

use App\Models\alqui_actualizacion;
use App\Models\alqui_ajuste;
use App\Models\alqui_contrato;
use App\Models\alqui_detalle;
use App\Models\alqui_garante;
use App\Models\alqui_inquilino;
use App\Models\alqui_moneda;
use App\Models\alqui_propietarios;
use App\Models\alqui_rel_contrato_garante;
use App\Models\persona_fisica;
use App\Models\persona_juridica;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


// use Livewire\WithPagination;


class ContratoComponent extends Component
{
    // use WithPagination;

    public $contrato_id, $bien_id, $fechainicio, $fechafin, $cuotas=12,$duracion=1, $detalles;
    public $monedas, $actualizaciones, $tipoajustes;

    public $intereses_punitorios_id=1, $gastos_administrativos, $gastosadmin, $actualizacion_id, $cant_meses, $html, $cmbIvaAlquiler, $cmbIvaAdmin;

    protected $inquilino_id_nuevo, $inquilinos_filtrados_fisica, $inquilinos_filtrados_juridica, $propietarios_filtrados_fisica, $propietarios_filtrados_juridica, $search;

    public $inquilinos_filtrados_fisica_id,$inquilinos_filtrados_juridica_id,$propietarios_filtrados_fisica_id,$propietarios_filtrados_juridica_id, $lugar_pago_inquilino=1;
    public $bien_type=1, $periodos_observaciones='', $detalles_administra='', $detalles_lugar_pago, $detalles_cartera='', $estado=false, $actualizaciones_id, $tipoajustes_id;
    public $incluir_mora_graficos=true;
    public $c_part_por_diario, $c_part_dia_inicio, $c_part_dias_gracia, $c_part_porcentaje;
    public $porcentaje_administrativos=0, $valor_administrativos=0, $administra_alquiler_id=1, $activo, $gastos_administrativos_id, $inquilino_id, $propietario_id, $cobrar_administrativos_punitorios=false, $reintegrar_punitorios=false, $moneda_id, $ajuste_id, $admin_porc, $admin_monto, $seguro_id=3, $vencimiento, $seguro_observaciones, $liquidacion_fraccionada;

    public $c_general_por_diario=0, $c_general_dia_inicio=0, $c_general_dias_gracia=0,$c_general_porcentaje=0;

    public $propietario_text, $inquilino_text, $garante_text, $buscar, $listado_fisicas, $listado_juridicas;
    public $garantes, $garantes_ids, $numero;
    public $valor = [60];
    public $updateTypes = [];
    public $mostratModalOk=false, $modalCambioInquilino=false, $modalRescindirContrato=false, $modalRenovarContrato=false, $NuevaFechaInicioContrato, $modalGestionarConceptos, $verConceptos=1;

    public $OCDetalle, $OCMonto, $OCContrato, $OCMes_Todos, $OCMes, $OCMesSolo, $OCRepetir, $OCCalculo, $OCAgregar;

    public function mount() { $this->fechainicio = date_create()->format('Y-m-d'); $this->gastosadmin = 1; $this->bien_id = 1; $this->actualizacion_id = 1; }

    public function render() {

        $this->gastos_administrativos_id=1;
        
        $this->updateTypes['a1'] = 0;
        $this->Cargarlistados(); //Carga los listados de los inquilinos y de los propietarios, tanto para las personas físicas como a las jurídicas
        $this->CambiarSeguro();
        $this->monedas = alqui_moneda::all();   // Carga el listado de monedas disponibles
        $this->actualizaciones = alqui_actualizacion::orderby('cantmeses')->get();  // Carga el listado de actualizaciones
        $this->tipoajustes = alqui_ajuste::all();   // Carga los distintos tipos de ajuste de contrato IPC, BNA, etc
        $this->CambiarFechaInicio();
        $this->CambiarActualizacion();  // Calcula y dibuja todas las escalas de actualización de los Valores
        // dd(session('contrato_id'));
        if(session('contrato_id')) { $this->CargarDatosDelContrato(session('contrato_id')); }

        return view('livewire.contrato.contrato-component',['inquilinos_filtrados_fisica'=>$this->inquilinos_filtrados_fisica,'inquilinos_filtrados_juridica'=>$this->inquilinos_filtrados_juridica,'propietarios_filtrados_fisica'=>$this->propietarios_filtrados_fisica,'propietarios_filtrados_juridica'=>$this->propietarios_filtrados_juridica])->extends('adminlte::page');
        // return view('livewire.contrato.contrato-component',['inquilinos_filtrados_fisica'=>$this->inquilinos_filtrados_fisica,'inquilinos_filtrados_juridica'=>$this->inquilinos_filtrados_juridica,'propietarios_filtrados_fisica'=>$this->propietarios_filtrados_fisica,'propietarios_filtrados_juridica'=>$this->propietarios_filtrados_juridica])->extends('adminlte::page');
    }

    public function CambiarCuotas() { $this->cuotas = $this->duracion * 12; $this->CambiarActualizacion(); }
    public function CambiarFechaInicio() { $this->fechafin = date("Y-m-d", strtotime($this->fechainicio . "+ ".$this->duracion." year -1 day")); }
    public function CambiarIntereses() { $this->intereses_punitorios_id = $this->intereses_punitorios_id; }
    public function CerrarModalOk() { $this->mostratModalOk = false; return redirect()->route('principal'); }

    public function CerrarModalRenovarContrato() { $this->modalRenovarContrato = false; }
    public function AbrirModalRenovarContrato() { $this->modalRenovarContrato = true; }
    public function RenovarContrato() {
        
        $this->validate([
            'NuevaFechaInicioContrato'=>'required',
        ]);

        // Desactiva Contrato
        alqui_contrato::where('id', $this->contrato_id)->update(['activo' => false,]);

        // Elimina conceptos impagos si es que está marcada la opcion
        // CODIGO
        
        // Se crea un nuevo contrato con el mismo propietario, inmueble e inquilino
        $contrato = alqui_contrato::find( $this->contrato_id);
        $newContrato = $contrato->replicate();

        // Se le asigna la nueva fecha de inicio del contrato
        $newContrato->fechainicio=$this->NuevaFechaInicioContrato;
        $newContrato->activo = true;
        $newContrato->save();

        // Se relacionan los garantes
        $garantes = alqui_rel_contrato_garante::where('contrato_id','=',$this->contrato_id)->get();
        foreach($garantes as $garante) {
            $newgarante = $garante->replicate();
            $newgarante->contrato_id = $newContrato->id;
            $newgarante->save();
        }


        $this->CerrarModalRenovarContrato();
        $this->contrato_id = null; session(['contrato_id'=>null]);
        session()->flash('mensaje', 'Se Renovó el contrato.');
    }

    public function CerrarModalRescindirContrato() { $this->modalRescindirContrato = false; }
    public function AbrirModalRescindirContrato() { $this->modalRescindirContrato = true; }
    public function RescindirContrato() {
        
        // Desactiva Contrato
        alqui_contrato::where('id', $this->contrato_id)->update(['activo' => false,]);

        // Elimina conceptos impagos si es que está marcada la opcion
        // CODIGO
        $this->CerrarModalRescindirContrato();
        session()->flash('mensaje', 'Se Rescindió el contrato.');
    }

    public function CerrarModalCambioInquilino() { $this->modalCambioInquilino = false; }
    public function AbrirModalCambioInquilino() { $this->CargarListado('Inquilinos'); $this->modalCambioInquilino = true; }
    public function CambiarInquilino() {
        $this->validate([
            'inquilino_text'=>'required',
            'inquilino_id'=>'required',
        ]);
        // Desactiva Contrato
        alqui_contrato::where('id', $this->contrato_id)->update(['activo' => false,]);

        // Elimina conceptos impagos si es que está marcada la opcion
        // CODIGO

        // Se crea un nuevo contrato con el mismo propietario e inmueble
        $contrato = alqui_contrato::find( $this->contrato_id);
        $newContrato = $contrato->replicate();
        // Se le asigna el inquilino elegido al nuevo contrato
        $newContrato->inquilino_id = $this->inquilino_id;
        $newContrato->activo = true;
        $newContrato->save();

        session()->flash('mensaje', 'Se actualizó el inquilino.');

        // dd($newContrato);
        // dd(($this->inquilino_id.'-'.$this->inquilino_text.'-'.$this->contrato_id));
    }
    
    public function MostrarConceptos($id) {
        if($id==1) $this->verConceptos=1;
        if($id==2) $this->verConceptos=2;
    }
    public function CerrarModalGestionarConceptos() { $this->modalGestionarConceptos = false; }

    public function CambiarSeguro() { $this->seguro_id = $this->seguro_id;  if($this->seguro_id==3) $this->vencimiento=date(now()); }
    
    public function AbrirModalGestionarConceptos() { 
        $this->modalGestionarConceptos = true;
        if($this->contrato_id) { 
            $contrato = alqui_contrato::find($this->contrato_id);
            $this->valores =  array($contrato->valores);
            $this->detalles = alqui_detalle::where('contrato_id','=',$this->contrato_id)->orderby('fecha_vencimiento')->get(); 
            if(count($this->updateTypes)>count($this->valores)){ 
                $contrato->valores = $this->updateTypes;
                $contrato->save();
            }

        }
    }

    public function CambiarValores() { 
        // $this->updateTypes(count($this->updateTypes));
        // $a= count($this->updateTypes);
        // array_push($this->updateTypes, [
        //     "id" => $a,
        //     "qty" => 'pepe',
        // ]);
        dd($this->updateTypes);
    }

    public function CambiarAdministrativos() { 
        // dd($this->gastosadmin);
        // dd($this->gastos_administrativos);
        $this->gastos_administrativos = $this->gastos_administrativos_id; 
        // if($this->gastos_administrativos==2) { $this->porcentaje_administrativos = 0; } else { $this->valor_administrativos = 0; }
    }

    public function CambiarActualizacion() { 
        $this->updateTypes = [];
        $b = alqui_actualizacion::find($this->actualizacion_id); 
        $this->cant_meses = $b->cantmeses;
        // dd($this->cant_meses);
        $this->OCMes = [];

        $html1='';
        $a = 1;
        $fecha_inicial = $this->fechainicio; 
        $fecha_final = date("Y-m-d", strtotime($fecha_inicial . "+ ".$this->cant_meses." months"));

        for($i=1; $i<$this->cuotas/$this->cant_meses + 1; $i++) {
            
            $html1=$html1.'<tr>
                                <td style="text-align: center;">Cuota '.$a.' <br>
                                    <label style="font-size: 0.7rem">'.substr($fecha_inicial,8,2).'-'.substr($fecha_inicial,5,2).'-'.substr($fecha_inicial,0,4).'</label>
                                </td>
                                <td style="text-align: center;">Cuota '. $i*$this->cant_meses. '<br>
                                    <label style="font-size: 0.7rem">'.substr($fecha_final,8,2).'-'.substr($fecha_final,5,2).'-'.substr($fecha_final,0,4).'</label>
                                </td>
                                <td style="text-align: center;">';
            if($i==1) { $html1 = $html1 . '<input type="text" value="'.$i.'" size="16" wire:model="updateTypes.a'.$i.'" style="background-color: aquamarine;border: black solid 1px;text-align: center;"><br>
                <label style="font-size: 0.8rem">
                    Valor Inicial
                </label>'; } 
            else { $html1 = $html1 . '<input type="text" value="'.$i.'" size="16" wire:model="updateTypes.a'.$i.'" style="background-color: floralwhite; border: black solid 1px;text-align: center;"><br> <label style="font-size: 0.8rem">Valor Parcial</label>'; }
            $html1 = $html1 . '</td>
                            </tr>';
            $a = $i*$this->cant_meses+1;

            $fecha_inicial = date("Y-m-d", strtotime($fecha_final . "+ 1 days")); 
            $fecha_final = date("Y-m-d", strtotime($fecha_inicial . "+ ".$this->cant_meses." months"));
        }
        $this->html = $html1;

        // Carga el combo del detalle de conceptos adicionales
        $fecha_inicial = $this->fechainicio; 
        for($i=1; $i<$this->cuotas+1; $i++) {
            array_push($this->OCMes,date("M", strtotime($fecha_inicial)).'/'.date("Y", strtotime($fecha_inicial)));
            $fecha_inicial = date("Y-m-d", strtotime($fecha_inicial . "+ 1 months"));
        }
        // dd($this->OCMes);
    }

    public function CambiarMeses() {
        // dd($this->OCMes_Todos);
        // if($this->OCMes_Todos=='T') { $this->OCMes_Todos = '1'; } else { $this->OCMes_Todos = 'T'; }
        // dd($this->OCMes_Todos);
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

    public function CargarDatosDelContrato($contrato_id) {
        $a = alqui_contrato::find($contrato_id);
        $this->duracion=$a->duracion;
        $this->cuotas=$a->cuotas;
        $this->fechainicio=$a->fechainicio;
        $this->fechafin=$a->fechafin;
        $this->periodos_observaciones=$a->periodos_observaciones;
        $this->moneda_id=$a->moneda_id;
        $this->actualizacion_id=$a->actualizacion_id;
        $this->ajuste_id=$a->tipoajustes_id;
        $this->bien_type=$a->bien_type;
        $this->bien_id=$a->bien_id;
        $this->inquilino_id=$a->inquilino_id; //1, //$a->inquilino_id,    //Buscar ;
        $this->propietario_id=$a->propietario_id; //$a->propietario_id,    //Buscar ;
        $this->activo=$a->activo;
        $this->administra_alquiler_id=$a->administra_alquiler_id;
        $this->lugar_pago_inquilino=$a->lugar_pago_inquilino;
        $this->detalles_cartera=$a->detalles_cartera;
        $this->incluir_mora_graficos = $a->incluir_mora_graficos;
        $this->intereses_punitorios_id=$a->intereses_punitorios_id;
        $this->c_general_por_diario = $a->porcentaje_diario;
        $this->c_general_dia_inicio = $a->dia_inicio;
        $this->c_general_dias_gracia = $a->dias_gracia;
        $this->c_general_porcentaje = $a->base_de_calculo;
        $this->reintegrar_punitorios = $a->reintegrar_punitorios;
        $this->cobrar_administrativos_punitorios = $a->cobrar_administrativos_punitorios;
        $this->gastos_administrativos_id=$a->gastos_administrativos_id;
        $this->valor_administrativos=$a->valor_administrativos;
        $this->porcentaje_administrativos=$a->porcentaje_administrativos;
        $this->cant_meses=$a->cant_meses;
        $this->seguro_id=$a->seguro_id;
        $this->vencimiento=$a->vencimiento;
        $this->seguro_observaciones=$a->seguro_observaciones;
        $this->liquidacion_fraccionada=$a->liquidacion_fraccionada;
        // $this->valores = json_encode($a->updateTypes); // ;
        $this->ajuste_id=$a->ajuste_id;

        
        $prop = alqui_propietarios::where('persona_id','=',$a->propietario_id)->get();
        if($prop[0]->persona_type=='fisica') { 
            $propietario = persona_fisica::find($prop[0]->persona_id);         
            $this->propietario_text =  $propietario->apellidos . ', '. $propietario->nombres;
        } else { 
            $propietario = persona_juridica::find($prop->persona_id); 
            $this->propietario_text =  $propietario->razonsocial;
        }
        $this->propietario_id = $propietario->id;
        
        $prop = alqui_inquilino::where('persona_id','=',$a->inquilino_id)->get();
        if($prop[0]->persona_type=='fisica') { 
            $inquilino = persona_fisica::find($prop[0]->persona_id);         
            $this->inquilino_text =  $inquilino->apellidos . ', '. $inquilino->nombres;
        } else { 
            $inquilino = persona_juridica::find($prop->persona_id); 
            $this->inquilino_text =  $inquilino->razonsocial;
        }
        $this->inquilino_id = $inquilino->id;
        
        $garan = alqui_rel_contrato_garante::where('contrato_id','=',$contrato_id)->get();
        
        foreach($garan as $gara) {
            if($gara->persona_type=='fisica') { 
                $garantes = persona_fisica::find($gara->garante_id);
                $this->garantes[$garantes->id] = array($garantes->apellidos.', '.$garantes->nombres, (string) $garantes->id, 'fisica');       
            } else { 
                $garantes = persona_juridica::find($gara->garante_id); 
                $this->garantes[$garantes->id] = array($garantes->razonsocial, (string) $garantes->id, 'juridica');       
            }
        }
        
        $rangos = json_decode($a->valores);

        $i = 1 ;
        if($rangos) {
            foreach($rangos as $rango) {
                $r = 'a'.$i;
                $this->updateTypes[$r] = $rangos->$r;
                $i++;
            }
        }
        $this->contrato_id = $contrato_id;
        // dd($this->updateTypes);
        // $this->CambiarActualizacion();
    }

    public function store() {
        // dd($this->updateTypes['a1']);
        if(isset($this->updateTypes['a1']) && is_numeric($this->updateTypes['a1'])) {} else {  session()->flash('mensaje', 'Falta definir el valor para el primer período.'); dd('a'); exit; };
        // dd($this->updateTypes);
        $this->validate ([
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
            
            'c_general_por_diario'=>'required',
            'c_general_dia_inicio'=>'required',
            'c_general_dias_gracia'=>'required',
            'c_general_porcentaje'=>'required',

            'intereses_punitorios_id'=>'required',
            
            'gastos_administrativos_id'=>'required',
            'valor_administrativos'=>'required',
            'porcentaje_administrativos'=>'required',

            'cant_meses'=>'required',            
            'ajuste_id'=>'required',
        
            'seguro_id'=>'required',
            'vencimiento'=>'required',

            'inquilino_id'=>'required',
            'propietario_id'=>'required',
            'garantes'=>'required',

            // 'updateTypes'=>'required|numeric',
        ]);
                // dd(json_encode($this->updateTypes));

            // dd($this->actualizaciones_id);
        $a = alqui_contrato::updateOrCreate(['id' => $this->contrato_id],[
            'duracion'=>$this->duracion,
            'cuotas'=>$this->cuotas,
            'fechainicio'=>$this->fechainicio,
            'fechafin'=>$this->fechafin,
            'periodos_observaciones'=>$this->periodos_observaciones,
            'moneda_id'=>$this->moneda_id,
            'actualizacion_id'=>1, //$this->actualizaciones_id,
            'ajuste_id'=>$this->tipoajustes_id,
            'bien_type'=>$this->bien_type,
            'bien_id'=>$this->bien_id,
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
            'seguro_id'=>$this->seguro_id,
            'vencimiento'=>$this->vencimiento,
            'seguro_observaciones'=>$this->seguro_observaciones,
            'liquidacion_fraccionada'=>$this->liquidacion_fraccionada,
            // 'valores' => json_encode( array_slice($this->updateTypes, 0, $this->cant_meses)),   // solo guarda los rangos definidos
            'valores' => json_encode($this->updateTypes),
            'ajuste_id'=>$this->ajuste_id,
            'activo'=>true,
            'user_id'=>Auth::user()->id,

        ]);

        // dd($this->garantes);
        $b = alqui_rel_contrato_garante::where('contrato_id','=', $a->id)->update(['activo'=>false]);

        foreach($this->garantes as $garante) {
            $rel = new alqui_rel_contrato_garante([
                'contrato_id' =>$a->id,
                'garante_id' =>$garante[1],
                'persona_type' =>$garante[2],
                'activo' =>true,
            ]);
            $rel->save();


            // dd($a);
            // $a = alqui_rel_contrato_garante::updateOrCreate(['contrato_id' => $a->id, 'garante_id' =>$garante[1], (string)'persona_type' =>"'".$garante[2]."'",],[
            //     'contrato_id' =>$a->id,
            //     'garante_id' =>$garante[1],
            //     'persona_type' =>$garante[2],
            //     'activo' =>true,
            // ]);
        // dd($a->id);
        }
        // if($this->contrato_id==null) {
        //     $this->GuardarConceptos($a->id);
        // }

        $this->mostratModalOk = true;
        session()->flash('mensaje', 'Se guardó el contrato.');

        // 'bien_id'=>$this->bien_id,C
    }

    public function GuardarOtrosConceptos() {
        alqui_detalle::where('contrato_id','=',$this->contrato_id)->where('vistaprevia','=',1)->delete(); // Elimina todos los restos anteriores sin terminar
        if($this->OCContrato<>"1") { // Busca todos los contratos de la inmobiliaria y los coloca en un array
            $contratos = alqui_contrato::where('user_id','=',Auth::user()->id)->get('id'); 
            $cantidad_de_contratos = count($contratos);
        } else {
            $contratos = alqui_contrato::where('id','=',$this->contrato_id)->get(); 
            $cantidad_de_contratos = 1;
        }
        
        for($i=0;$i<$cantidad_de_contratos;$i++) {  // Este primer bucle se itera desde 1 hasta la cantidad de contratos a actualizar
            $detalle = new alqui_detalle();
            if($this->OCMes_Todos="1") {
                $this->CargarAnioMesYCuota($detalle,$this->OCMesSolo,$this->contrato_id);                
                $this->CargarAgregarA($detalle,$this->OCMonto);

            } else {

            }
        }
        
        $this->detalles = alqui_detalle::where('contrato_id','=',$this->contrato_id)->orderby('fecha_vencimiento')->get();
    }

    public function CargarAgregarA($detalle, $monto) {
        switch($this->OCAgregar) {
            case 'I': //Recibo inquilino
                $detalle->monto = $monto; 
                $detalle->quien = 'Inq.';
                $detalle->signo = '+'; 
                $detalle->detalle = 'Recibo inquilino' . $this->OCDetalle; 
        // dd($detalle);

                if($this->NoEstaRepetido($detalle->detalle,$detalle->anio,$detalle->quien,$detalle->mes,$detalle->contrato_id)) $detalle->save();
                break;
            case 'P': //Liquidación Propietario
                $detalle->monto = $monto; 
                $detalle->quien = 'Prop.';
                $detalle->signo = '-'; 
                $detalle->detalle = 'Liquidación Propietario' . $this->OCDetalle; 
                if($this->NoEstaRepetido($detalle->detalle,$detalle->anio,$detalle->quien,$detalle->mes,$detalle->contrato_id)) $detalle->save();
                break; 
            case 'C': //Ambos Cancelación
                $detalle->monto = $monto; 
                $detalle->quien = 'Inq.';
                $detalle->signo = '+'; 
                $detalle->detalle = 'Ambos Cancelación' . $this->OCDetalle; 
                if($this->NoEstaRepetido($detalle->detalle,$detalle->anio,$detalle->quien,$detalle->mes,$detalle->contrato_id)) $detalle->save();
                $detalle->quien = 'Prop.';
                $detalle->signo = '-'; 
                if($this->NoEstaRepetido($detalle->detalle,$detalle->anio,$detalle->quien,$detalle->mes,$detalle->contrato_id)) $detalle->save();
                break; 
            case 'D': break; //Ambos Duplicado
                $detalle->monto = $monto; 
                $detalle->quien = 'Inq.';
                $detalle->signo = '+'; 
                $detalle->detalle = 'Ambos Duplicado' . $this->OCDetalle; 
                if($this->NoEstaRepetido($detalle->detalle,$detalle->anio,$detalle->quien,$detalle->mes,$detalle->contrato_id)) $detalle->save();
                $detalle->monto = -$monto; 
                $detalle->quien = 'Prop.';
                $detalle->signo = '+'; 
                if($this->NoEstaRepetido($detalle->detalle,$detalle->anio,$detalle->quien,$detalle->mes,$detalle->contrato_id)) $detalle->save();
                break; 
            case 'M': break; //Ambos 50% cada uno
                $detalle->monto = $monto/2; 
                $detalle->quien = 'Inq.';
                $detalle->signo = '+'; 
                $detalle->detalle = 'Ambos 50% cada uno' . $this->OCDetalle; 
                if($this->NoEstaRepetido($detalle->detalle,$detalle->anio,$detalle->quien,$detalle->mes,$detalle->contrato_id)) $detalle->save();
                $detalle->monto = -$monto/2; 
                $detalle->quien = 'Prop.';
                $detalle->signo = '+'; 
                if($this->NoEstaRepetido($detalle->detalle,$detalle->anio,$detalle->quien,$detalle->mes,$detalle->contrato_id)) $detalle->save();
                break; 
        }
    }

    public function CargarAnioMesYCuota($detalle, $periodo, $contrato_id) {
        switch(substr($periodo,0,3)) {
            case 'Jan': $detalle->mes='01'; break;
            case 'Feb': $detalle->mes='02'; break;
            case 'Mar': $detalle->mes='03'; break;
            case 'Apr': $detalle->mes='04'; break;
            case 'May': $detalle->mes='05'; break;
            case 'Jun': $detalle->mes='06'; break;
            case 'Jul': $detalle->mes='07'; break;
            case 'Aug': $detalle->mes='08'; break;
            case 'Sep': $detalle->mes='09'; break;
            case 'Oct': $detalle->mes='10'; break;
            case 'Nov': $detalle->mes='11'; break;
            case 'Dec': $detalle->mes='12'; break;
        }
        $detalle->anio = substr($periodo,-4,4);
        $a = alqui_detalle::where('contrato_id','=',$contrato_id)
        ->where('mes','=',$detalle->mes)
        ->where('anio','=',$detalle->anio)
        ->get();
        $detalle->fecha_vencimiento = $a[0]['fecha_vencimiento']; 
        $detalle->cuota = $a[0]['cuota'];
        $detalle->contrato_id = $contrato_id;
        $detalle->vistaprevia = true;
        $detalle->mostrar_en_conceptos = true;

            //OCDetalle
            //OCMonto
            //OCContrato  // Este contrato, todos los contratos ?
            //OCMes_Todos // Sólo este més o todos los meses
            //OCMes       // Mes seleccionado
//
            //OCRepetir
            //OCCalculo
            //OCAgregar
    }

    public function GuardarConceptos() {

        if(session('contrato_id')) {
        $b = alqui_contrato::find(session('contrato_id'));
        
        alqui_detalle::where('contrato_id','=',$this->contrato_id)
        ->where('vistaprevia','=',1)
        ->delete();

        $cuotas_totales = $b->cuotas;
        $fecha_inicio = $b->fechainicio;
        $cant_meses = alqui_actualizacion::find($b->actualizacion_id)->cantmeses;
        // dd(count($this->updateTypes));
        $valores =json_decode($b->valores);
        $mes_del_periodo = 1;
        $periodo = 1;
        $mes = 1;

        for($i=1;$i<=$cant_meses*count($this->updateTypes);$i++) {
            // for($i=1;$i<=$cuotas_totales;$i++) {
            $detalle = new alqui_detalle();

            $r = 'a'.$periodo;
            $detalle->monto = $valores->$r;
            $this->CargarDetalle($detalle,'Alquiler',true,true,$i,'Inq.',$fecha_inicio);
            if($this->NoEstaRepetido('Alquiler',$detalle->anio,$detalle->quien,$detalle->mes,$this->contrato_id)) $detalle->save();            

            // $detalle->detalle ='Alquiler';
            // $r = 'a'.$periodo;
            // $detalle->monto = $valores->$r;
            // $detalle->mostrar_en_conceptos = true;
            // $detalle->vistaprevia = true;
            // $detalle->mes = date("m",strtotime($fecha_inicio));
            // $detalle->anio = date("Y",strtotime($fecha_inicio));
            // $detalle->cuota = $i;
            // $detalle->quien = 'Inq.';
            // $detalle->contrato_id = session('contrato_id');
            // $fecha_vencimiento =  date("Y-m-d", strtotime($fecha_inicio . "+ 10 days"));
            // $detalle->fecha_vencimiento = date("Y-m-d", strtotime($fecha_vencimiento . "+ 1 month"));            


            // IVA Agregar Discriminado
            // ========================
            if($this->cmbIvaAlquiler == 'd') {
                $detalle = new alqui_detalle();
                
                $r = 'a'.$periodo;
                $detalle->monto = $valores->$r*0.21;    // Diferencia
                $this->CargarDetalle($detalle,'Iva Alquiler',true,true,$i,'Inq.',$fecha_inicio);
                if($this->NoEstaRepetido('Iva Alquiler',$detalle->anio,$detalle->quien,$detalle->mes,$this->contrato_id)) $detalle->save();            

                alqui_detalle::where('contrato_id','=',$this->contrato_id)->where('detalle','=','Alquiler con iva')->where('vistaprevia','=',1)->delete();  // Elimina los detalles si está seleccionado Sumar al 

                // $detalle->detalle ='Iva Alquiler'; $r = 'a'.$periodo; $detalle->mostrar_en_conceptos = true; $detalle->vistaprevia = true; $detalle->mes = date("m",strtotime($fecha_inicio)); $detalle->anio = date("Y",strtotime($fecha_inicio)); $detalle->cuota = $i; $detalle->quien = 'Inq.'; $detalle->contrato_id = session('contrato_id'); $detalle->fecha_vencimiento = date("Y-m-d", strtotime($fecha_vencimiento . "+ 1 month"));

            }

            if($this->cmbIvaAlquiler == 's') {
                $detalle = new alqui_detalle();
                $r = 'a'.$periodo;
                $detalle->monto = $valores->$r*1.21;    // Diferencia
                $this->CargarDetalle($detalle,'Alquiler con iva',true,true,$i,'Inq.',$fecha_inicio);
                if($this->NoEstaRepetido('Alquiler con iva',$detalle->anio,$detalle->quien,$detalle->mes,$this->contrato_id)) $detalle->save();
                alqui_detalle::where('contrato_id','=',$this->contrato_id)->where('detalle','=','Alquiler')->where('vistaprevia','=',1)->delete();  // Elimina los detalles si está seleccionado Sumar al 
            }
             
            
            if($this->cmbIvaAdmin == 'd') {
                $detalle = new alqui_detalle();
                $r = 'a'.$periodo;
                if($b->valor_administrativos<>0) { $detalle->monto = $b->valor_administrativos; } else { $detalle->monto = $valores->$r*$b->porcentaje_administrativos/100; }   // Diferencia }
                $this->CargarDetalle($detalle,'Honorarios Profesionales',true,true,$i,'Prop.',$fecha_inicio);
                if($this->NoEstaRepetido('Honorarios Profesionales',$detalle->anio,$detalle->quien,$detalle->mes,$this->contrato_id)) $detalle->save();
                alqui_detalle::where('contrato_id','=',$this->contrato_id)->where('detalle','=','Alquiler')->where('vistaprevia','=',1)->delete();  // Elimina los detalles si está seleccionado Sumar al 
            }

            if($this->cmbIvaAdmin == 's') {
                $detalle = new alqui_detalle();
                $r = 'a'.$periodo;
                if($b->valor_administrativos<>0) { $detalle->monto = $b->valor_administrativos; } else { $detalle->monto = $valores->$r*$b->porcentaje_administrativos/100*1.21; }   // Diferencia }
                $this->CargarDetalle($detalle,'Honorarios Profesionales con iva',true,true,$i,'Prop.',$fecha_inicio);
                if($this->NoEstaRepetido('Honorarios Profesionales con iva',$detalle->anio,$detalle->quien,$detalle->mes,$this->contrato_id)) $detalle->save();
                alqui_detalle::where('contrato_id','=',$this->contrato_id)->where('detalle','=','Alquiler')->where('vistaprevia','=',1)->delete();  // Elimina los detalles si está seleccionado Sumar al 
            }

                $fecha_inicio = date("Y-m-d", strtotime($fecha_inicio . "+ 1 month"));    
                if($mes_del_periodo==$cant_meses) { $mes_del_periodo=1; $periodo++; } else { $mes_del_periodo++; }
                $mes++;      
            }
        }
        $this->detalles = alqui_detalle::where('contrato_id','=',$this->contrato_id)->orderby('fecha_vencimiento')->get();
    }

    public function CargarDetalle($detalle, $strDetalle,$mostrar,$vistaprevia,$cuota,$quien,$fecha_inicio) {
        $detalle->detalle =$strDetalle;
        $detalle->mostrar_en_conceptos = $mostrar;
        $detalle->vistaprevia = $vistaprevia;
        $detalle->mes = date("m",strtotime($fecha_inicio));
        $detalle->anio = date("Y",strtotime($fecha_inicio));
        $detalle->cuota = $cuota;
        $detalle->quien = $quien;
        $detalle->contrato_id = session('contrato_id');
        $fecha_vencimiento =  date("Y-m-d", strtotime($fecha_inicio . "+ 10 days"));
        $detalle->fecha_vencimiento = date("Y-m-d", strtotime($fecha_vencimiento . "+ 1 month")); 
    }

    public function NoEstaRepetido($detalle, $anio, $quien, $mes, $contrato_id) {
        $aa = alqui_detalle::where('detalle','=',$detalle)
        ->where('quien','=',$quien)
        ->where('anio','=',  $anio)
        ->where('mes','=',$mes)
        ->where('contrato_id','=',$contrato_id)
        ->get();
        if(count($aa)==0) return true; // si no está grabado, lo graba, sino lo deja pasar
    }

    public function FijarDetalles() {
        if(session('contrato_id')) {
            if($this->cmbIvaAlquiler == '0') { alqui_detalle::where('contrato_id','=',$this->contrato_id)->where('detalle','=','Alquiler con iva')->where('vistaprevia','=',1)->delete(); } // Elimina los detalles si está seleccionado Sumar al alquiler
            if($this->cmbIvaAlquiler == 's') { alqui_detalle::where('contrato_id','=',$this->contrato_id)->where('detalle','=','Alquiler')->where('vistaprevia','=',1)->delete(); } // Elimina los detalles si está seleccionado Sumar al alquiler

            $aa = alqui_detalle::where('contrato_id','=',$this->contrato_id)->update(['vistaprevia'=>0]);
            $this->detalles = alqui_detalle::where('contrato_id','=',$this->contrato_id)->orderby('fecha_vencimiento')->get();
            session()->flash('mensaje', 'Se Fijaron los detalles.');
        }
    }

    public function BorrarVistaPrevia() { $this->detalles = []; }
    
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

    // public function VerGarantes() {
    //     dd(json_encode($this->garantes));
    // }

    public function Elegir($tipo, $id) {
        if($tipo=='fisica') {
            switch ($this->buscar) {
                case 'Propietarios':
                    $a = persona_fisica::find($id); $this->propietario_text = $a->apellidos.', '.$a->nombres; $this->propietario_id = $a->id; break;
                case 'Inquilinos':
                    $a = persona_fisica::find($id); $this->inquilino_text = $a->apellidos.', '.$a->nombres; $this->inquilino_id = $a->id; break;
                case 'Garantes':
                    // $a = persona_fisica::find($id); $this->garantes[$a->id] = $a->apellidos.', '.$a->nombres; break;
                    $a = persona_fisica::find($id); $this->garantes[$a->id] = array($a->apellidos.', '.$a->nombres, (string) $a->id, 'fisica'); break;
            }
        } else {
            switch ($this->buscar) {
                case 'Propietarios':
                    $a = persona_juridica::find($id); $this->propietario_text = $a->razonsocial;  $this->propietario_id = $a->id; break;
                case 'Inquilinos':
                    $a = persona_juridica::find($id); $this->inquilino_text = $a->razonsocial; $this->inquilino_id= $a->id; break;
                case 'Garantes':
                    $a = persona_juridica::find($id); $this->garantes[$a->id] = array($a->razonsocial, (string) $a->id, 'juridica'); break;
            }
        }
        // dd($a->id);
    }

    public function EliminarGarante($id) {
        // $a = $this->garantes;
        if($this->contrato_id) {
            $b = alqui_rel_contrato_garante::where('contrato_id','=', $this->contrato_id)
            ->where('garante_id','=', $this->garantes[$id][1])
            ->update(['activo'=>false]);
        }
        unset($this->garantes[$id]);
        $this->garantes = $this->garantes; //array_values($a); //$a; // array_values($a);

        // $this->garantes=null;
        // dd($a);
        // dd($this->garantes[$id][1]);
        // $my_array = array_diff($a, array($this->garantes[$id][1]));
        // dd($this->garantes);
    }
}
