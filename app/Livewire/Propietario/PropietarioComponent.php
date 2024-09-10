<?php

namespace App\Livewire\Propietario;

use Livewire\Component;

class PropietarioComponent extends Component
{
    public function render()
    {
        return view('livewire..propietario.propietario-component')->extends('adminlte::page');
    }
}
