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
        Schema::create('articulos', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->string('codigo',12);
            $table->string('nombre',100);
            $table->string('descripcion',255);
            $table->decimal('precio',$precision = 9,$scale = 2);
            $table->unsignedTinyInteger('moneda');
            $table->unsignedMediumInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('SET NULL');
            $table->unsignedTinyInteger('subcategoria_id')->nullable();
            $table->foreign('subcategoria_id')->references('id')->on('subcategorias')->onDelete('SET NULL');
            $table->unsignedTinyInteger('estado')->default(1);
            $table->unsignedMediumInteger('visualizaciones')->default(0);
            $table->string('foto_1',50)->nullable()->default(NULL);
            $table->string('foto_2',50)->nullable()->default(NULL);
            $table->string('foto_3',50)->nullable()->default(NULL);
            $table->string('foto_4',50)->nullable()->default(NULL);
            $table->string('foto_5',50)->nullable()->default(NULL);
            $table->string('foto_6',50)->nullable()->default(NULL);
            $table->string('foto_7',50)->nullable()->default(NULL);
            $table->string('foto_8',50)->nullable()->default(NULL);
            $table->comment('Tabla con la información principal de los artículos del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};
