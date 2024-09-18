<?php

namespace App\Livewire\Garante;

use Livewire\Component;
use App\Models\alqui_garante;
use App\Models\persona_fisica;
use App\Models\persona_juridica;
use App\Models\domicilio;
use App\Models\iva;
use App\Models\provincia as provincias;
use App\Models\localidad as localidades;
use Livewire\WithPagination;

class GaranteComponent extends Component
{
    //alqui_garante
    public $persona_type, $persona_id, $search;

    public $ivas, $provincias, $localidades, $provincia_id, $localidad_id;
    protected $garantes_fisica;
    protected $garantes_juridica;

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

        // $this->garantes = persona_fisica::all();

        $this->Buscar();

        // dd($this->garantes_juridica);
        return view('livewire.garante.garante-component',['garantes_fisica'=>$this->garantes_fisica,'garantes_juridica'=>$this->garantes_juridica])->extends('adminlte::page');
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
        $this->garantes_fisica='';
        $this->garantes_juridica='';
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
        $this->persona_id = null;
    }

    public function Buscar() {
        $this->garantes_fisica = alqui_garante::join('persona_fisicas','alqui_garantes.persona_id','persona_fisicas.id')
        ->join('domicilios','persona_fisicas.domicilio_id','domicilios.id')
        ->join('ivas','persona_fisicas.iva_id','ivas.id')
        ->join('provincias','domicilios.provincia_id','provincias.id')
        ->join('localidads','domicilios.localidad_id','localidads.id')
        ->where('alqui_garantes.persona_type','=','fisica')
        ->where('persona_fisicas.activo','=',true)
        ->where('persona_fisicas.nombres','like',  '%' . $this->search . '%')
        ->paginate(5);
        
        $this->garantes_juridica = alqui_garante::join('persona_juridicas','alqui_garantes.persona_id','persona_juridicas.id')
        ->join('domicilios','persona_juridicas.domicilio_id','domicilios.id')
        ->join('ivas','persona_juridicas.iva_id','ivas.id')
        ->join('provincias','domicilios.provincia_id','provincias.id')
        ->join('localidads','domicilios.localidad_id','localidads.id')
        ->where('alqui_garantes.persona_type','=','juridica')
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
// dd($this->persona_id);
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
        if($this->persona_id) {} else {
            $garante = new alqui_garante;
            $garante->persona_type = $this->persona_type;
            $garante->persona_id = $pers->id;
            $garante->save();
        }

        $this->persona_id = null;
        $this->domicilio_id = null;
        session()->flash('message', 'Se guardaron los datos.');
    }

    public function edit($id, $per_type) {
        $this->persona_id = $id;
        $this->persona_type = $per_type;
        if($per_type=='fisica') {
            $garantes_fisica = alqui_garante::join('persona_fisicas','alqui_garantes.persona_id','persona_fisicas.id')
            ->join('domicilios','persona_fisicas.domicilio_id','domicilios.id')
            ->join('ivas','persona_fisicas.iva_id','ivas.id')
            ->join('provincias','domicilios.provincia_id','provincias.id')
            ->join('localidads','domicilios.localidad_id','localidads.id')
            ->where('persona_id','=',$id)
            ->get();
            // dd($garantes_fisica);
            $this->cuil = $garantes_fisica[0]->cuil ;
            $this->apellidos = $garantes_fisica[0]->apellidos ;
            $this->nombres = $garantes_fisica[0]->nombres ;
            $this->dni = $garantes_fisica[0]->dni ;
            $this->telefono = $garantes_fisica[0]->telefono ;
            $this->whatsapp = $garantes_fisica[0]->whatsapp ;
            $this->email_id = $garantes_fisica[0]->email_id ;
            $this->iva_id = $garantes_fisica[0]->iva_id ;
            $this->fechanacimiento = $garantes_fisica[0]->fechanacimiento ;
            $this->calle = $garantes_fisica[0]->calle;
            $this->localidad_id = $garantes_fisica[0]->localidad_id;
            $this->provincia_id = $garantes_fisica[0]->provincia_id;
            $this->observaciones = $garantes_fisica[0]->observaciones ;
            // dd('termino');
        } else {
            $this->persona_type='juridica';

            $garantes_juridica = alqui_garante::join('persona_juridicas','alqui_garantes.persona_id','persona_juridicas.id')
            ->join('domicilios','persona_juridicas.domicilio_id','domicilios.id')
            ->join('provincias','domicilios.provincia_id','provincias.id')
            ->join('localidads','domicilios.localidad_id','localidads.id')
            ->where('persona_id','=',$id)
            ->get();
            $this->cuit = $garantes_juridica[0]->cuit ;
            $this->razonsocial = $garantes_juridica[0]->razonsocial ;
            $this->telefono = $garantes_juridica[0]->telefono ;
            $this->whatsapp = $garantes_juridica[0]->whatsapp ;
            $this->email_id = $garantes_juridica[0]->email_id ;
            $this->iva_id = $garantes_juridica[0]->iva_id ;
            $this->fechainicioact = $garantes_juridica[0]->fechainicioact ;
            $this->calle = $garantes_juridica[0]->calle;
            $this->localidad_id = $garantes_juridica[0]->localidad_id;
            $this->provincia_id = $garantes_juridica[0]->provincia_id;
            $this->observaciones = $garantes_juridica[0]->observaciones ;
        }
    }

}
