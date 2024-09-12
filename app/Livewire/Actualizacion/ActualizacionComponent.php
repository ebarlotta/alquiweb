<?php

namespace App\Livewire\Actualizacion;

use Livewire\Component;
use App\Models\alqui_actualizacion as Actualizaciones;

class ActualizacionComponent extends Component
{
    public $actualizaciones, $actualizacion_id;
    public $actualizaciondescripcion, $cantmeses;


    public function render()
    {
        $this->actualizaciones = Actualizaciones::all();
        return view('livewire.actualizacion.actualizacion-component')->extends('adminlte::page');
    }
    
    public function store() {
        $this->validate = [
            'actualizaciondescripcion'=>'required',
            'cantmeses'=>'required',
        ];

        Actualizaciones::updateOrCreate(['id' => $this->actualizacion_id], [
            'actualizaciondescripcion' => $this->actualizaciondescripcion,
            'cantmeses' => $this->cantmeses,
        ]);
        
        $this->actualizacion_id = null;
        session()->flash('mensaje', 'Se guardó la actualización.');
    }

    public function edit($id) {
        $this->actualizacion_id = $id;
        $actualizacion = Actualizaciones::find($id);
        $this->actualizaciondescripcion = $actualizacion->actualizaciondescripcion;
        $this->cantmeses = $actualizacion->cantmeses;
    }
}
