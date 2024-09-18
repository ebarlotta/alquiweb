<?php

namespace App\Livewire\Principal;

use App\Models\alqui_contrato;
use Livewire\Component;
use Livewire\WithPagination;

class PrincipalComponent extends Component
{
    use WithPagination;

    public $contratos;

    public function render()
    {
        $this->contratos = alqui_contrato::all();
        return view('livewire.principal.principal-component')->extends('layouts.app');
    }
}
