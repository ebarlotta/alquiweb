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
        Schema::create('alqui_detalles', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_vencimiento');
            $table->string('detalle');
            $table->double('monto');
            $table->boolean('mostrar_en_conceptos');
            $table->integer('mes');
            $table->integer('anio');
            $table->integer('cuota');
            $table->unsignedBigInteger('contrato_id');

            $table->timestamps();

            $table->foreign('contrato_id')->references('id')->on('alqui_contratos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alqui_detalles');
    }
};
