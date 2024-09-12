<?php

namespace App\Livewire\Moneda;

use Livewire\Component;
use App\Models\alqui_moneda;

class MonedaComponent extends Component
{
    public $monedas, $moneda_id;
    public $monedadescripcion, $signo;

    public function render()
    {
        $this->monedas = alqui_moneda::all();
        return view('livewire.moneda.moneda-component')->extends('adminlte::page');
    }

    public function store() {
        $this->validate = [
            'monedadescripcion'=>'required',
            'signo'=>'required',
        ];

        alqui_moneda::updateOrCreate(['id' => $this->moneda_id], [
            'monedadescripcion' => $this->monedadescripcion,
            'signo' => $this->signo,
        ]);
        
        $this->moneda_id = null;
        session()->flash('mensaje', 'Se guardó la moneda.');
    }

    public function edit($id) {
        $this->moneda_id = $id;
        $moneda = alqui_moneda::find($id);
        $this->monedadescripcion = $moneda->monedadescripcion;
        $this->signo = $moneda->signo;
    }
}
