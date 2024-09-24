<?php

namespace App\Livewire\Contrato;

use App\Models\alqui_actualizacion;
use App\Models\alqui_ajuste;
use App\Models\alqui_contrato;
use App\Models\alqui_garante;
use App\Models\alqui_inquilino;
use App\Models\alqui_moneda;
use App\Models\alqui_propietarios;
use App\Models\alqui_rel_contrato_garante;
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

    protected $inquilino_id_nuevo, $inquilinos_filtrados_fisica, $inquilinos_filtrados_juridica, $propietarios_filtrados_fisica, $propietarios_filtrados_juridica, $search;

    public $inquilinos_filtrados_fisica_id,$inquilinos_filtrados_juridica_id,$propietarios_filtrados_fisica_id,$propietarios_filtrados_juridica_id, $lugar_pago_inquilino=1;
    public $bien_type=1, $periodos_observaciones='', $detalles_administra='', $detalles_lugar_pago, $detalles_cartera='', $estado=false, $actualizaciones_id, $tipoajustes_id;
    public $incluir_mora_graficos=true;
    public $c_part_por_diario, $c_part_dia_inicio, $c_part_dias_gracia, $c_part_porcentaje;
    public $porcentaje_administrativos=0, $valor_administrativos=0, $administra_alquiler_id=1, $activo, $gastos_administrativos_id=1, $inquilino_id, $propietario_id, $cobrar_administrativos_punitorios=false, $reintegrar_punitorios=false, $moneda_id, $ajuste_id, $admin_porc, $admin_monto, $seguro_id=3, $vencimiento, $seguro_observaciones, $liquidacion_fraccionada;

    public $c_general_por_diario=0, $c_general_dia_inicio=0, $c_general_dias_gracia=0,$c_general_porcentaje=0;

    public $propietario_text, $inquilino_text, $garante_text, $buscar, $listado_fisicas, $listado_juridicas;
    public $garantes, $garantes_ids, $numero;
    public $valor = [60];
    public $updateTypes = [];
    public $mostratModalOk=false, $modalCambioInquilino=false, $modalRescindirContrato=false, $modalRenovarContrato=false, $NuevaFechaInicioContrato, $modalGestionarConceptos;

    public function mount() { $this->fechainicio = date_create()->format('Y-m-d'); }

    public function render() {
        
        $this->bien_id = 1;

        $this->Cargarlistados();
        $this->CambiarSeguro();
        $this->monedas = alqui_moneda::all();
        $this->actualizaciones = alqui_actualizacion::orderby('cantmeses')->get();
        $this->tipoajustes = alqui_ajuste::all();
        $this->CambiarFechaInicio();
        $this->CambiarActualizacion();
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
    
    public function CerrarModalGestionarConceptos() { $this->modalGestionarConceptos = false; }
    public function AbrirModalGestionarConceptos() { $this->modalGestionarConceptos = true; }



    public function CambiarValores() { 
        // $this->updateTypes(count($this->updateTypes));
        // $a= count($this->updateTypes);
        // array_push($this->updateTypes, [
        //     "id" => $a,
        //     "qty" => 'pepe',
        // ]);
        dd($this->updateTypes);
    }
    // public function CambiarValores($id, $val) { $this->valor[$id] = $val;  dd( $this->valor[$id]);}
    public function CambiarSeguro() { $this->seguro_id = $this->seguro_id;  if($this->seguro_id==3) $this->vencimiento=date(now()); }

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
            
            $html1=$html1.'<tr>
                                <td style="text-align: center;">Cuota '.$a.' <br>
                                    <label style="font-size: 0.7rem">'.substr($fecha_inicial,8,2).'-'.substr($fecha_inicial,5,2).'-'.substr($fecha_inicial,0,4).'</label>
                                </td>
                                <td style="text-align: center;">Cuota '. $i*$this->cant_meses. '<br>
                                    <label style="font-size: 0.7rem">'.substr($fecha_final,8,2).'-'.substr($fecha_final,5,2).'-'.substr($fecha_final,0,4).'</label>
                                </td>
                                <td style="text-align: center;">';
            if($i==1) { $html1 = $html1 . '<input type="number" size="16" wire:model="updateTypes.'.$i.'" style="background-color: aquamarine;border: black solid 1px;text-align: center;"><br>
                <label style="font-size: 0.8rem">
                    Valor Inicial
                </label>'; } 
            else { $html1 = $html1 . '<input type="number" size="16" wire:model="updateTypes.'.$i.'" style="background-color: floralwhite;
                border: black solid 1px;text-align: center;"><br>
                <label style="font-size: 0.8rem">Valor Parcial</label>'; }
            $html1 = $html1 . '</td>
                            </tr>';
        
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

    public function CargarDatosDelContrato($contrato_id) {
        $a = alqui_contrato::find($contrato_id);
        $this->duracion=$a->duracion;
        $this->cuotas=$a->cuotas;
        $this->fechainicio=$a->fechainicio;
        $this->fechafin=$a->fechafin;
        $this->periodos_observaciones=$a->periodos_observaciones;
        $this->moneda_id=$a->moneda_id;
        $this->actualizacion_id=1; //$a->actualizaciones_id;
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

        $this->contrato_id = $contrato_id;
    }

    public function store() {

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

            // dd($this->propietario_id."pppp");
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
            'valores' => json_encode($this->updateTypes), // garantes
            'ajuste_id'=>$this->ajuste_id,        

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

        }

        $this->mostratModalOk = true;
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

    public function VerGarantes() {
        dd(json_encode($this->garantes));
    }

    public function Elegir($tipo, $id) {
        if($tipo=='fisica') {
            switch ($this->buscar) {
                case 'Propietarios':
                    $a = persona_fisica::find($id); $this->propietario_text = $a->apellidos.', '.$a->nombres; $this->propietario_id = $a->id; break;
                case 'Inquilinos':
                    $a = persona_fisica::find($id); $this->inquilino_text = $a->apellidos.', '.$a->nombres; $this->inquilino_id = $a->id; dd(($this->inquilino_id.'-'.$this->inquilino_text.'-'.$this->contrato_id)); break;
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
