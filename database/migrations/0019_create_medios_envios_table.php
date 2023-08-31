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
        Schema::create('medios_envios', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->string('medio',25);
            $table->decimal('costo',$precision = 7,$scale = 2)->nullable();
            $table->unsignedTinyInteger('estado')->default(1);
            $table->comment('Tabla con los medios de envío del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medios_envios');
    }
};
