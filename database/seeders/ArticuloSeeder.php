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
        for ($i = 1; $i <= 30; $i++) {
            Articulo::create([
                "codigo"            => sprintf("%04d", $i),
                "nombre"            => "Item $i",
                "descripcion"       => "Descripción item $i",
                "precio"            => $i * 100.00,
                "moneda"            => 1,
                "categoria_id"      => ($i % 3) + 1,
                "subcategoria_id"   => $i % 2 == 0 ? $i % 3 + 1 : NULL,
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
}
