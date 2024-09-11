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
        Schema::create('persona_fisicas', function (Blueprint $table) {
            $table->id();
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('cuil');
            $table->bigInteger('dni');
            $table->date('fechanacimiento');
            $table->string('observaciones');
            $table->string('email_id');
            $table->string('telefono');
            $table->string('whatsapp');
            $table->unsignedBigInteger('iva_id');
            $table->unsignedBigInteger('domicilio_id');
            $table->boolean('activo');

            $table->timestamps();

            $table->foreign('iva_id')->references('id')->on('ivas');
            $table->foreign('domicilio_id')->references('id')->on('domicilios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona_fisicas');
    }
};
