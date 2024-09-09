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
        Schema::create('alqui_rel_propiedad_propietarios', function (Blueprint $table) {
            $table->id();
            $table->double('porcentaje');
            $table->unsignedBigInteger('propiedad_id');
            $table->string('persona_type');
            $table->unsignedBigInteger('persona_id');
            $table->boolean('activo');

            $table->timestamps();

            $table->foreign('propiedad_id')->references('id')->on('alqui_propiedads');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alqui_rel_propiedad_propietarios');
    }
};
