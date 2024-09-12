<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alqui_contratos', function (Blueprint $table) {
            $table->id();
            $table->double('duracion');
            $table->double('cuota');
            $table->date('fechainicio');
            $table->date('fechafin');
            $table->string('observaciones');
            $table->unsignedBigInteger('moneda_id');
            $table->unsignedBigInteger('actualizacion_id');
            $table->unsignedBigInteger('ajuste_id');
            $table->string('bien_type');
            $table->unsignedBigInteger('bien_id');
            $table->unsignedBigInteger('inquilino_id');
            $table->unsignedBigInteger('propietario_id');
            $table->boolean('activo');
            
            $table->timestamps();

            $table->foreign('moneda_id')->references('id')->on('alqui_monedas');
            $table->foreign('inquilino_id')->references('id')->on('alqui_inquilinos');
            $table->foreign('propietario_id')->references('id')->on('alqui_propietarios');
            $table->foreign('actualizacion_id')->references('id')->on('alqui_actualizacions');
            $table->foreign('ajuste_id')->references('id')->on('alqui_ajustes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alqui_contratos');
    }
};
