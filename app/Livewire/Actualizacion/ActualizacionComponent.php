<?php

namespace App\Livewire\Actualizacion;

use Livewire\Component;
use App\Models\alqui_actualizacion as Actualizaciones;

class ActualizacionComponent extends Component
{
    public $actualizaciones;

    public function render()
    {
        $this->actualizaciones = Actualizaciones::all();
        return view('livewire.actualizacion.actualizacion-component')->extends('adminlte::page');
    }
}
