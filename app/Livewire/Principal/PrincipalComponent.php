<?php

namespace App\Livewire\Principal;

use App\Models\alqui_contrato;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class PrincipalComponent extends Component
{
    use WithPagination;

    // public $contratos;
    protected $contratos;
    public $contrato_id, $mostrarModalEliminarContrato=false, $todos=1, $search;

    // public function mount() {
    //     $this->CambiarVista(1);
    // }

    public function render()
    {
        $this->CambiarVista($this->todos);
        return view('livewire.principal.principal-component')->with('contratos',$this->contratos)->extends('layouts.app');
        // return view('livewire.principal.principal-component')->with('contratos',$this->contratos)->extends('layouts.app');
    }

    public function CargarIdContrato($contrato_id) { session(['contrato_id' => $contrato_id]); return redirect()->route('contratos'); }
    public function NuevoContrato() { session(['contrato_id' => null]); return redirect()->route('contratos'); }

    public function modalEliminarContrato($id) { $this->mostrarModalEliminarContrato = true; $this->contrato_id = $id; }
    public function cerrarModalEliminarContrato() { $this->mostrarModalEliminarContrato = false; }
    public function EliminarContrato() { 
        alqui_contrato::where('id', $this->contrato_id)->update(['activo' => false,]);  
        $this->contrato_id =null; 
        session()->flash('mensaje', 'Se eliminó el contrato.'); 
        $this->cerrarModalEliminarContrato();
    }

    // select * from `alqui_contratos` inner join `alqui_propietarios` on `alqui_propietarios`.`persona_id` = `alqui_contratos`.`propietario_id` inner join `persona_fisicas` on `alqui_propietarios`.`persona_id` = `persona_fisicas`.`id` where `apellidos` like '%%' and `nombres` like '%%' and `alqui_contratos`.`activo` = 1; 
    // select * from `alqui_contratos` inner join `alqui_propietarios` on `alqui_propietarios`.`persona_id` = `alqui_contratos`.`propietario_id` inner join `persona_fisicas` on `alqui_propietarios`.`persona_id` = `persona_fisicas`.`id` where `apellidos` like '%%' and `nombres` like '%%' and `alqui_contratos`.`activo` = 1
    
    public function CambiarVista($vista) {
        // dd($vista);
        if($vista==0) { 
            $this->todos = 0; 
            $this->contratos = alqui_contrato::join('alqui_propietarios','alqui_propietarios.persona_id','alqui_contratos.propietario_id')
            ->join('persona_fisicas','alqui_propietarios.persona_id','persona_fisicas.id')
            ->get('alqui_contratos.*');
            // ->where('apellidos','like','%'.$this->search.'%')
            // ->where('nombres','like','%'.$this->search.'%')
            // ->where('alqui_contratos.activo','=',1)->paginate(10);
            
        } else { 
            $this->todos = 1;
            // $this->contratos = DB::select('select alqui_contratos.* from `alqui_contratos` inner join `alqui_propietarios` on `alqui_propietarios`.`persona_id` = `alqui_contratos`.`propietario_id` inner join `persona_fisicas` on `alqui_propietarios`.`persona_id` = `persona_fisicas`.`id` where `alqui_contratos`.`activo` = 1;' );
            
            $this->contratos = alqui_contrato::join('alqui_propietarios','alqui_propietarios.persona_id','alqui_contratos.propietario_id')
            ->join('persona_fisicas','alqui_propietarios.persona_id','persona_fisicas.id')
            // ->where('apellidos','like','\'%'.$this->search.'%\'')
            // ->where('nombres','like','\'%'.$this->search.'%\'')
            // ->where('alqui_contratos.activo','=',1)->paginate(10);
            ->where('alqui_contratos.activo','=',1)->get('alqui_contratos.*');
            // dd($this->contratos);
        }
        // if($vista==0) { $this->contratos = alqui_contrato::paginate(10); }
        // if($vista==1) { $this->contratos = alqui_contrato::where('activo','=',true)->paginate(10); }
    }

}
