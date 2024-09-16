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
        Schema::create('alqui_rel_contrato_garantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contrato_id');
            $table->unsignedBigInteger('garante_id');
            $table->boolean('activo');

            $table->timestamps();

            $table->foreign('contrato_id')->references('id')->on('alqui_contratos');
            $table->foreign('garante_id')->references('id')->on('alqui_garantes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alqui_rel_contrato_garantes');
    }
};
