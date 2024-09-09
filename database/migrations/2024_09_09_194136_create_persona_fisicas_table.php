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
            $table->string('dni');
            $table->date('fechanacimiento');
            $table->string('observaciones');
            $table->string('activo');
            $table->unsignedBigInteger('email_id');
            $table->unsignedBigInteger('telefono_id');
            $table->unsignedBigInteger('iva_id');
            $table->unsignedBigInteger('domicilio_id');

            $table->timestamps();

            $table->foreign('email_id')->references('id')->on('emails');
            $table->foreign('telefono_id')->references('id')->on('telefonos');
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
