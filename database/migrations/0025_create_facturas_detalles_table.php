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
        Schema::create('facturas_detalles', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->unsignedMediumInteger('factura_id');
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
            $table->unsignedMediumInteger('articulo_id');
            $table->string('codigo',12);
            $table->string('nombre',100);
            $table->string('descripcion',255);
            $table->string('opciones',50);
            $table->decimal('precio');
            $table->unsignedTinyInteger('moneda');
            $table->unsignedMediumInteger('cantidad');
            $table->decimal('subtotal');
            $table->unsignedTinyInteger('medio_envio_id');
            $table->foreign('medio_envio_id')->references('id')->on('medios_envios')->onUpdate('cascade');
            $table->comment('Tabla con el detalle de cada factura del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas_detalles');
    }
};
