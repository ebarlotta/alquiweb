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
            $table->double('cuotas');
            $table->date('fechainicio');
            $table->date('fechafin');
            $table->string('periodos_observaciones')->nullable();
            $table->unsignedBigInteger('moneda_id');
            $table->unsignedBigInteger('actualizacion_id');
            $table->unsignedBigInteger('ajuste_id');
            $table->string('bien_type');    // 1. Alquiler | 2.Vehículo | 3.Mueble
            $table->unsignedBigInteger('bien_id');
            $table->unsignedBigInteger('inquilino_id');
            $table->unsignedBigInteger('propietario_id');
            $table->boolean('activo');

            $table->string('administra_alquiler_id'); // 1. Administra / 2. No Administra / 3. Otro
            $table->string('lugar_pago_inquilino');  // 1.Efectivo en local | 2.Transferencia a Inmobiliaria | 3. Transferencia a propietario | 4. Nos especifica
            $table->string('detalles_cartera');
            $table->boolean('incluir_mora_graficos');
            
            $table->unsignedBigInteger('intereses_punitorios_id')->default(1); // 1.Conf.General Inmobi | 2.Conf Particular | 3.No cobra
            $table->double('porcentaje_diario')->default(0);
            $table->double('dia_inicio')->default(0);
            $table->double('dias_gracia')->default(0);
            $table->string('base_de_calculo')->default('Todos los conceptos');  // Todos los conceptos / Unicamente el Alquiler
            
            $table->boolean('reintegrar_punitorios')->default(false);
            $table->boolean('cobrar_administrativos_punitorios')->default(false);
            
            $table->boolean('gastos_administrativos_id')->default(false); // 1.gastos_porcentual_alquiler | 2.monto_en_pesos
            $table->double('valor_administrativos')->default(0);
            $table->double('porcentaje_administrativos')->default(0);

            $table->integer('cant_meses')->default(12);

            $table->unsignedBigInteger('seguro_id');
            $table->date('vencimiento')->nullable();
            $table->string('seguro_observaciones')->nullable();

            $table->boolean('liquidacion_fraccionada')->default(0);
            $table->string('valores')->default(0);
            

            $table->timestamps();

            $table->foreign('moneda_id')->references('id')->on('alqui_monedas');
            // $table->foreign('inquilino_id')->references('persona_id')->on('alqui_inquilinos');
            // $table->foreign('propietario_id')->references('persona_id')->on('alqui_propietarios');
            $table->foreign('actualizacion_id')->references('id')->on('alqui_actualizacions');
            $table->foreign('ajuste_id')->references('id')->on('alqui_ajustes');
            // $table->foreign('intereses_punitorios_id')->references('id')->on('intereses_punitorios');
            $table->foreign('seguro_id')->references('id')->on('seguros');
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
