<?php

namespace App\Livewire\Contrato;

use App\Models\alqui_actualizacion;
use App\Models\alqui_ajuste;
use App\Models\alqui_moneda;
use Livewire\Component;

class ContratoComponent extends Component
{
    public $fechainicio, $fechafin, $cuotas=12,$anios=1;
    public $monedas, $actualizaciones, $tipoajustes;

    public function mount() { $this->fechainicio = date_create()->format('Y-m-d'); }

    public function render()
    {
        $this->monedas = alqui_moneda::all();
        $this->actualizaciones = alqui_actualizacion::all();
        $this->tipoajustes = alqui_ajuste::all();
        $this->CambiarFechaInicio();
        return view('livewire..contrato.contrato-component')->extends('adminlte::page');
    }

    public function CambiarCuotas() { $this->cuotas = $this->anios * 12; }
    public function CambiarFechaInicio() { $this->fechafin = date("Y-m-d", strtotime($this->fechainicio . "+ ".$this->anios." year")); }

}
