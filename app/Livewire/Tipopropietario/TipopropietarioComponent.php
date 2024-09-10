<?php

namespace App\Livewire\Tipopropietario;

use Livewire\Component;
use App\Models\alqui_tipopropietario as TipoPropietarios;

class TipopropietarioComponent extends Component
{
    public $tipospropietarios;
    
    public function render()
    {
        $this->tipospropietarios = TipoPropietarios::all();
        return view('livewire.tipopropietario.tipopropietario-component')->extends('adminlte::page');
    }
}
