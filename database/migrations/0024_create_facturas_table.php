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
        Schema::create('facturas', function (Blueprint $table) {
            $table->unsignedInteger('id', true);
            $table->unsignedMediumInteger('numero');
            $table->dateTime('fecha');
            $table->unsignedTinyInteger('factura_tipo_id');
            $table->foreign('factura_tipo_id')->references('id')->on('facturas_tipos');
            $table->string('apellidos', 50);
            $table->string('nombres', 50);
            $table->unsignedTinyInteger('tipo_documento_id');
            $table->foreign('tipo_documento_id')->references('id')->on('tipos_documentos');
            $table->string('documento_nro', 8);
            $table->string('cuil', 11)->nullable();
            $table->string('cuit', 11)->nullable();
            $table->string('domicilio', 50);
            $table->string('domicilio_nro', 10);
            $table->string('domicilio_piso', 10)->nullable();
            $table->string('domicilio_depto', 10)->nullable();
            $table->string('localidad', 50);
            $table->string('codigo_postal', 10);
            $table->decimal('total',10,2);
            $table->unsignedTinyInteger('medio_pago_id');
            $table->foreign('medio_pago_id')->references('id')->on('medios_pagos')->onUpdate('CASCADE');
            $table->unsignedTinyInteger('medio_envio_id');
            $table->foreign('medio_envio_id')->references('id')->on('medios_envios')->onUpdate('CASCADE');
            $table->string('cae',14)->nullable()->default(NULL);
            $table->date('cae_vto');
            $table->unsignedTinyInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('facturas_estados');
            $table->comment('Tabla con la facturación del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
