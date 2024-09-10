<?php

namespace App\Livewire\Contrato;

use Livewire\Component;

class ContratoComponent extends Component
{
    public function render()
    {
        return view('livewire..contrato.contrato-component')->extends('adminlte::page');
    }
}
