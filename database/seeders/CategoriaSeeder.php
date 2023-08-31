<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            "nombre"        => "Categoría 1",
            "descripcion"   => "Descripción Categoría 1"
        ]);

        Categoria::create([
            "nombre"        => "Categoría 2",
            "descripcion"   => "Descripción Categoría 2"
        ]);

        Categoria::create([
            "nombre"        => "Categoría 3",
            "descripcion"   => "Descripción Categoría 3"
        ]);

        Categoria::create([
            "nombre"        => "Categoría 4",
            "descripcion"   => "Descripción Categoría 4"
        ]);

        Categoria::create([
            "nombre"        => "Categoría 5",
            "descripcion"   => "Descripción Categoría 5"
        ]);

        Categoria::create([
            "nombre"        => "Categoría 6",
            "descripcion"   => "Descripción Categoría 6"
        ]);

        Categoria::create([
            "nombre"        => "Categoría 7",
            "descripcion"   => "Descripción Categoría 7"
        ]);

        Categoria::create([
            "nombre"        => "Categoría 8",
            "descripcion"   => "Descripción Categoría 8"
        ]);
    }
}
