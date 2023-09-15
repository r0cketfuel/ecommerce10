<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Articulo;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Articulo::create([
            "codigo"            => "0001",
            "nombre"            => "Item 1",
            "descripcion"       => "Descripción item 1",
            "precio"            => 100.00,
            "moneda"            => 1,
            "categoria_id"      => 1,
            "subcategoria_id"   => 1,
            "estado"            => 1,
            "visualizaciones"   => 0,
            "foto_1"            => NULL,
            "foto_2"            => NULL,
            "foto_3"            => NULL,
            "foto_4"            => NULL,
            "foto_5"            => NULL,
            "foto_6"            => NULL,
            "foto_7"            => NULL,
            "foto_8"            => NULL,
        ]);

        Articulo::create([
            "codigo"            => "0002",
            "nombre"            => "Item 2",
            "descripcion"       => "Descripción item 2",
            "precio"            => 200.00,
            "moneda"            => 1,
            "categoria_id"      => 1,
            "subcategoria_id"   => 2,
            "estado"            => 1,
            "visualizaciones"   => 0,
            "foto_1"            => NULL,
            "foto_2"            => NULL,
            "foto_3"            => NULL,
            "foto_4"            => NULL,
            "foto_5"            => NULL,
            "foto_6"            => NULL,
            "foto_7"            => NULL,
            "foto_8"            => NULL,
        ]);

        Articulo::create([
            "codigo"            => "0003",
            "nombre"            => "Item 3",
            "descripcion"       => "Descripción item 3",
            "precio"            => 300.00,
            "moneda"            => 1,
            "categoria_id"      => 2,
            "subcategoria_id"   => NULL,
            "estado"            => 1,
            "visualizaciones"   => 0,
            "foto_1"            => NULL,
            "foto_2"            => NULL,
            "foto_3"            => NULL,
            "foto_4"            => NULL,
            "foto_5"            => NULL,
            "foto_6"            => NULL,
            "foto_7"            => NULL,
            "foto_8"            => NULL,
        ]);

        Articulo::create([
            "codigo"            => "0004",
            "nombre"            => "Item 4",
            "descripcion"       => "Descripción item 4",
            "precio"            => 400.00,
            "moneda"            => 1,
            "categoria_id"      => 1,
            "subcategoria_id"   => 1,
            "estado"            => 1,
            "visualizaciones"   => 0,
            "foto_1"            => NULL,
            "foto_2"            => NULL,
            "foto_3"            => NULL,
            "foto_4"            => NULL,
            "foto_5"            => NULL,
            "foto_6"            => NULL,
            "foto_7"            => NULL,
            "foto_8"            => NULL,
        ]);

        Articulo::create([
            "codigo"            => "0005",
            "nombre"            => "Item 5",
            "descripcion"       => "Descripción item 5",
            "precio"            => 500.00,
            "moneda"            => 1,
            "categoria_id"      => 1,
            "subcategoria_id"   => 1,
            "estado"            => 1,
            "visualizaciones"   => 0,
            "foto_1"            => NULL,
            "foto_2"            => NULL,
            "foto_3"            => NULL,
            "foto_4"            => NULL,
            "foto_5"            => NULL,
            "foto_6"            => NULL,
            "foto_7"            => NULL,
            "foto_8"            => NULL,
        ]);

        Articulo::create([
            "codigo"            => "0006",
            "nombre"            => "Item 6",
            "descripcion"       => "Descripción item 6",
            "precio"            => 600.00,
            "moneda"            => 1,
            "categoria_id"      => 1,
            "subcategoria_id"   => 1,
            "estado"            => 1,
            "visualizaciones"   => 0,
            "foto_1"            => NULL,
            "foto_2"            => NULL,
            "foto_3"            => NULL,
            "foto_4"            => NULL,
            "foto_5"            => NULL,
            "foto_6"            => NULL,
            "foto_7"            => NULL,
            "foto_8"            => NULL,
        ]);
    }
}
