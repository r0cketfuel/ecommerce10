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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->string('descripcion', 20);
            $table->decimal('cotizacion',10,2);
            $table->dateTime('fecha');
            $table->comment('Tabla con las cotizaciones de las diferentes monedas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};
