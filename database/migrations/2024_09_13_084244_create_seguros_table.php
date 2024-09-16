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
        Schema::create('seguros', function (Blueprint $table) {
            $table->id();
            $table->string('estado');  // 1.Trámite completo | 2. Trámite incompleto | 3.Otro
            $table->date('vencimiento');
            $table->string('tipo')->nullable();  // 1.Incendio | 2.Terceros | 3.Otro
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguros');
    }
};
