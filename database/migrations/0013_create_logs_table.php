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
        Schema::create('logs', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->string('usuario',16);
            $table->dateTime('fecha');
            $table->string('tipo',16);
            $table->string('evento',255);
            $table->comment('Tabla con los eventos del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
