<?php

namespace App\Livewire\Bienes;

use Livewire\Component;

class BienesComponent extends Component
{
    public function render()
    {
        return view('livewire..bienes.bienes-component')->extends('adminlte::page');
    }
}
