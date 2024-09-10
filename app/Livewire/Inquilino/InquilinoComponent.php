<?php

namespace App\Livewire\Inquilino;

use Livewire\Component;

class InquilinoComponent extends Component
{
    public function render()
    {
        return view('livewire..inquilino.inquilino-component')->extends('adminlte::page');
    }
}
