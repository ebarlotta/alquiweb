<?php

namespace App\Livewire\Ajuste;

use Livewire\Component;
use App\Models\alqui_ajuste;

class AjusteComponent extends Component
{
    public $ajustes, $ajuste_id, $ajustedescripcion;

    public function render()
    {
        $this->ajustes = alqui_ajuste::all();
        return view('livewire..ajuste.ajuste-component')->extends('adminlte::page');
    }

    public function store() {
        $this->validate = [
            'ajustedescripcion'=>'required',
        ];

        alqui_ajuste::updateOrCreate(['id' => $this->ajuste_id], [
            'ajustedescripcion' => $this->ajustedescripcion,
        ]);
        
        $this->ajuste_id = null;
        session()->flash('mensaje', 'Se guardó la moneda.');
    }

    public function edit($id) {
        $this->ajuste_id = $id;
        $ajuste = alqui_ajuste::find($id);
        $this->ajustedescripcion = $ajuste->ajustedescripcion;
    }
}
