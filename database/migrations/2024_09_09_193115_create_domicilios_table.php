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
        Schema::create('domicilios', function (Blueprint $table) {
            $table->id();
            $table->string('calle');
            $table->string('altura');
            $table->string('depto');
            $table->string('ubicaciongps');
            $table->string('observaciones');
            $table->boolean('activo');
            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('localidad_id');
            $table->timestamps();

            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('localidad_id')->references('id')->on('localidads');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domicilios');
    }
};
