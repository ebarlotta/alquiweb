<?php

use App\Livewire\Actualizacion\ActualizacionComponent;
use App\Livewire\Ajuste\AjusteComponent;
use App\Livewire\Bienes\BienesComponent;
use App\Livewire\Contrato\ContratoComponent;
use App\Livewire\Moneda\MonedaComponent;
use App\Livewire\Inquilino\InquilinoComponent;
use App\Livewire\Propietario\PropietarioComponent;
use App\Livewire\Tipopropiedades\TipopropiedadesComponent;
use App\Livewire\Tipopropietario\TipopropietarioComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/bienes', BienesComponent::class)->name('bienes');
Route::get('/propietarios', PropietarioComponent::class)->name('propietarios');
Route::get('/inquilinos', InquilinoComponent::class)->name('inquilinos');
Route::get('/contratos', ContratoComponent::class)->name('contratos');
Route::get('/tipospropiedades', TipopropiedadesComponent::class)->name('tipospropiedades');
Route::get('/tipospropietarios', TipopropietarioComponent::class)->name('tipospropietarios');
Route::get('/actualizaciones', ActualizacionComponent::class)->name('actualizaciones');
Route::get('/ajustes', AjusteComponent::class)->name('ajustes');
Route::get('/monedas', MonedaComponent::class)->name('monedas');