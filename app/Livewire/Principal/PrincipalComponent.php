<?php

namespace App\Livewire\Principal;

use App\Models\alqui_contrato;
use Livewire\Component;
use Livewire\WithPagination;

class PrincipalComponent extends Component
{
    use WithPagination;

    public $contratos, $contrato_id, $mostrarModalEliminarContrato=false;

    public function render()
    {
        $this->contratos = alqui_contrato::where('activo','=',true)->get();
        return view('livewire.principal.principal-component')->extends('layouts.app');
    }

    public function CargarIdContrato($contrato_id) {
        session(['contrato_id' => $contrato_id]);
        // session('contrato_id') = $contrato_id;
        return redirect()->route('contratos'); 
    }

    public function NuevoContrato() {
        session(['contrato_id' => null]);
        return redirect()->route('contratos'); 
    }

    public function modalEliminarContrato($id) { $this->mostrarModalEliminarContrato = true; $this->contrato_id = $id; }
    public function cerrarModalEliminarContrato() { $this->mostrarModalEliminarContrato = false; }
    public function EliminarContrato() { 
        alqui_contrato::where('id', $this->contrato_id)->update(['activo' => false,]);  
        $this->contrato_id =null; 
        session()->flash('mensaje', 'Se eliminó el contrato.'); 
        $this->cerrarModalEliminarContrato();
    }


}
