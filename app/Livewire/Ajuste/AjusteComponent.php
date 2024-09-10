<?php

namespace App\Livewire\Ajuste;

use Livewire\Component;
use App\Models\alqui_ajuste as Ajustes;

class AjusteComponent extends Component
{
    public $ajustes;
    
    public function render()
    {
        $this->ajustes = Ajustes::all();
        return view('livewire..ajuste.ajuste-component')->extends('adminlte::page');
    }
}
