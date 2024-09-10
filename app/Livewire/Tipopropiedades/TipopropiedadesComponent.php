<?php

namespace App\Livewire\Tipopropiedades;

use Livewire\Component;
use App\Models\alqui_tipopropiedad as TipoPropiedades;

class TipopropiedadesComponent extends Component
{
    public $tipospropiedades;

    public function render()
    {
        $this->tipospropiedades = TipoPropiedades::all();
        return view('livewire.tipopropiedades.tipopropiedades-component')->extends('adminlte::page');
    }
}
