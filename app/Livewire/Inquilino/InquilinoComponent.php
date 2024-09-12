<?php

namespace App\Livewire\Inquilino;

use Livewire\Component;
use App\Models\alqui_inquilino;
use App\Models\persona_fisica;
use App\Models\persona_juridica;
use App\Models\domicilio;
use App\Models\iva;
use App\Models\provincia as provincias;
use App\Models\localidad as localidades;
use Livewire\WithPagination;

class InquilinoComponent extends Component
{
    //alqui_inquilino
    public $persona_type, $persona_id, $search;

    public $ivas, $provincias, $localidades, $provincia_id, $localidad_id;
    protected $inquilinos_fisica;
    protected $inquilinos_juridica;

    //pers_fisica
    public $calle, $apellidos, $nombres, $cuil, $dni, $telefono, $whatsapp, $email_id, $iva_id, $fechanacimiento, $fechainicioact, $domicilio_id, $observaciones, $activo;
    
    //pers_juridica
    public $razonsocial, $cuit;

    use WithPagination;

    public function render() {

        if(is_null($this->persona_type)) { $this->persona_type='fisica'; }
        // dd($this->persona_type);
        
        $this->ivas = iva::all();
        $this->provincias = provincias::all();
        $this->localidades = localidades::all();

        // $this->inquilinos = persona_fisica::all();

        $this->Buscar();

        // dd($this->inquilinos_juridica);
        return view('livewire.inquilino.inquilino-component',['inquilinos_fisica'=>$this->inquilinos_fisica,'inquilinos_juridica'=>$this->inquilinos_juridica])->extends('adminlte::page');
    }

    public function Nuevo() {
        // $this->reset([]);
        $this->persona_id='';
        $this->search='';
        $this->ivas='';
        $this->provincias='';
        $this->localidades='';
        $this->provincia_id='';
        $this->localidad_id='';
        $this->inquilinos_fisica='';
        $this->inquilinos_juridica='';
        $this->calle='';
        $this->apellidos='';
        $this->nombres='';
        $this->cuil='';
        $this->dni='';
        $this->telefono='';
        $this->whatsapp='';
        $this->email_id='';
        $this->iva_id='';
        $this->fechanacimiento='';
        $this->fechainicioact='';
        $this->domicilio_id='';
        $this->observaciones='';
        $this->activo='';
        $this->razonsocial='';
        $this->cuit='';
    }

    public function Buscar() {
        $this->inquilinos_fisica = alqui_inquilino::join('persona_fisicas','alqui_inquilinos.persona_id','persona_fisicas.id')
        ->join('domicilios','persona_fisicas.domicilio_id','domicilios.id')
        ->join('ivas','persona_fisicas.iva_id','ivas.id')
        ->join('provincias','domicilios.provincia_id','provincias.id')
        ->join('localidads','domicilios.localidad_id','localidads.id')
        ->where('alqui_inquilinos.persona_type','=','fisica')
        ->where('persona_fisicas.activo','=',true)
        ->where('persona_fisicas.nombres','like',  '%' . $this->search . '%')
        ->paginate(5);
        
        $this->inquilinos_juridica = alqui_inquilino::join('persona_juridicas','alqui_inquilinos.persona_id','persona_juridicas.id')
        ->join('domicilios','persona_juridicas.domicilio_id','domicilios.id')
        ->join('ivas','persona_juridicas.iva_id','ivas.id')
        ->join('provincias','domicilios.provincia_id','provincias.id')
        ->join('localidads','domicilios.localidad_id','localidads.id')
        ->where('alqui_inquilinos.persona_type','=','juridica')
        ->where('persona_juridicas.activo','=',true)
        ->where('persona_juridicas.razonsocial','like',  '%' . $this->search . '%')
        ->paginate(5);
    }

    public function CambiarPersona($persona) {
        if($persona=='fisica') $this->persona_type='fisica';
        if($persona=='juridica') $this->persona_type='juridica';
    }

    public function CargarDatosParaBorrar($id, $per_type) { 
        $this->persona_id = $id;
        $this->persona_type = $per_type;
    }
    
    public function remove() {
        if($this->persona_type=='fisica') {
            $pers = persona_fisica::updateOrCreate(['id' => $this->persona_id], [
                'activo' => false,
            ]);

        } else {
            $pers = persona_juridica::updateOrCreate(['id' => $this->persona_id], [
                'activo' => false,
            ]);
        }
        $dom = domicilio::updateOrCreate(['id' => $pers->domicilio_id], [
            'activo' => false,
        ]); 
        $this->Buscar();

        session()->flash('message', 'Se guardaron los datos.');
    }

    public function store() {
    
        $fechainicial = date($this->fechanacimiento);
        $future =  strtotime('+18 years', strtotime($fechainicial));
        $future = date('Y-m-d', $future);

        $this->validate = [
            'calle' => 'required',
            'localidad_id' => 'required',
            'provincia_id' => 'required',
        ];

        $dom = domicilio::updateOrCreate(['id' => $this->domicilio_id], [
            'calle' => $this->calle,
            'localidad_id' => $this->localidad_id,
            'provincia_id' => $this->provincia_id,
            'altura' => '0',
            'depto' => '0',
            'ubicaciongps' => '0',
            'observaciones' => '0',
            'activo' => true,
        ]);    

        if($this->persona_type=='fisica') {
            $this->validate = [
                'cuil' => 'required',
                'apellidos' => 'required',
                'nombres' => 'required',
                'dni' => 'required|integer|min:90000000|max:100000000',
                'telefono' => 'required',
                'whatsapp' => 'required',
                'email_id' => 'required',
                'iva_id' => 'required',
                'fechanacimiento' => 'required|after_or_equal:now',
            ];

            $pers = persona_fisica::updateOrCreate(['id' => $this->persona_id], [
                'cuil' => $this->cuil,
                'apellidos' => $this->apellidos,
                'nombres' => $this->nombres,
                'dni' => $this->dni,
                'telefono' => $this->telefono,
                'whatsapp' => $this->whatsapp,
                'email_id' => $this->email_id,
                'iva_id' => $this->iva_id,
                'fechanacimiento' => $this->fechanacimiento,
                'domicilio_id' => $dom->id,
                'observaciones' => $this->observaciones,
                'activo' => true,
            ]);

        } else {
            $this->validate = [
                'cuit' => 'required',
                'razonsocial' => 'required',
                'telefono' => 'required',
                'whatsapp' => 'required',
                'email_id' => 'required',
                'iva_id' => 'required',
            ];

            $pers = persona_juridica::updateOrCreate(['id' => $this->persona_id], [
                'cuit' => $this->cuit,
                'razonsocial' => $this->razonsocial,
                'telefono' => $this->telefono,
                'whatsapp' => $this->whatsapp,
                'email_id' => $this->email_id,
                'iva_id' => $this->iva_id,
                'fechainicioact' => $this->fechanacimiento,
                'domicilio_id' => $dom->id,
                'observaciones' => $this->observaciones,
                'activo' => true,
            ]);
        }

        $inquilino = new alqui_inquilino;
        $inquilino->persona_type = $this->persona_type;
        $inquilino->persona_id = $pers->id;
        $inquilino->save();

        $this->persona_id = null;
        $this->domicilio_id = null;
        session()->flash('message', 'Se guardaron los datos.');
    }

    public function edit($id, $per_type) {
        
        $this->persona_type = $per_type;
        if($per_type=='fisica') {
            $inquilinos_fisica = alqui_inquilino::join('persona_fisicas','alqui_inquilinos.persona_id','persona_fisicas.id')
            ->join('domicilios','persona_fisicas.domicilio_id','domicilios.id')
            ->join('ivas','persona_fisicas.iva_id','ivas.id')
            ->join('provincias','domicilios.provincia_id','provincias.id')
            ->join('localidads','domicilios.localidad_id','localidads.id')
            ->where('persona_id','=',$id)
            ->get();
            // dd($inquilinos_fisica);
            $this->cuil = $inquilinos_fisica[0]->cuil ;
            $this->apellidos = $inquilinos_fisica[0]->apellidos ;
            $this->nombres = $inquilinos_fisica[0]->nombres ;
            $this->dni = $inquilinos_fisica[0]->dni ;
            $this->telefono = $inquilinos_fisica[0]->telefono ;
            $this->whatsapp = $inquilinos_fisica[0]->whatsapp ;
            $this->email_id = $inquilinos_fisica[0]->email_id ;
            $this->iva_id = $inquilinos_fisica[0]->iva_id ;
            $this->fechanacimiento = $inquilinos_fisica[0]->fechanacimiento ;
            $this->calle = $inquilinos_fisica[0]->calle;
            $this->localidad_id = $inquilinos_fisica[0]->localidad_id;
            $this->provincia_id = $inquilinos_fisica[0]->provincia_id;
            $this->observaciones = $inquilinos_fisica[0]->observaciones ;
            // dd('termino');
        } else {
            $this->persona_type='juridica';

            $inquilinos_juridica = alqui_inquilino::join('persona_juridicas','alqui_inquilinos.persona_id','persona_juridicas.id')
            ->join('domicilios','persona_juridicas.domicilio_id','domicilios.id')
            ->join('provincias','domicilios.provincia_id','provincias.id')
            ->join('localidads','domicilios.localidad_id','localidads.id')
            ->where('persona_id','=',$id)
            ->get();
            $this->cuit = $inquilinos_juridica[0]->cuit ;
            $this->razonsocial = $inquilinos_juridica[0]->razonsocial ;
            $this->telefono = $inquilinos_juridica[0]->telefono ;
            $this->whatsapp = $inquilinos_juridica[0]->whatsapp ;
            $this->email_id = $inquilinos_juridica[0]->email_id ;
            $this->iva_id = $inquilinos_juridica[0]->iva_id ;
            $this->fechainicioact = $inquilinos_juridica[0]->fechainicioact ;
            $this->calle = $inquilinos_juridica[0]->calle;
            $this->localidad_id = $inquilinos_juridica[0]->localidad_id;
            $this->provincia_id = $inquilinos_juridica[0]->provincia_id;
            $this->observaciones = $inquilinos_juridica[0]->observaciones ;
        }
    }

}
