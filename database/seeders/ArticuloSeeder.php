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
            "foto_1"            => "IMG_20220520_180024708.jpg",
            "foto_2"            => "IMG_20220520_180028433.jpg",
            "foto_3"            => "IMG_20220520_180032771.jpg",
            "foto_4"            => "IMG_20220520_180042943.jpg",
            "foto_5"            => "IMG_20220520_180050483.jpg",
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
            "foto_1"            => "IMG_20220520_183551326.jpg",
            "foto_2"            => "IMG_20220520_183531935.jpg",
            "foto_3"            => "IMG_20220520_183536598.jpg",
            "foto_4"            => "IMG_20220520_183542600.jpg",
            "foto_5"            => "IMG_20220520_183623310.jpg",
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
            "foto_1"            => "IMG_20220520_184323961.jpg",
            "foto_2"            => "IMG_20220520_184331267.jpg",
            "foto_3"            => "IMG_20220520_184335904.jpg",
            "foto_4"            => "IMG_20220520_184347983.jpg",
            "foto_5"            => "IMG_20220520_184357330.jpg",
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
            "foto_1"            => "IMG_20220520_184749412.jpg",
            "foto_2"            => "IMG_20220520_184816833.jpg",
            "foto_3"            => "IMG_20220520_184822803.jpg",
            "foto_4"            => "IMG_20220520_184826813.jpg",
            "foto_5"            => "IMG_20220520_184830463.jpg",
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
            "foto_1"            => "IMG_20211026_190604597.jpg",
            "foto_2"            => "IMG_20211026_190608898.jpg",
            "foto_3"            => "IMG_20211026_190612029.jpg",
            "foto_4"            => "IMG_20211026_190615750.jpg",
            "foto_5"            => "IMG_20211026_190727797.jpg",
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
            "foto_1"            => "IMG_20200317_161839482.jpg",
            "foto_2"            => "IMG_20200317_161848271.jpg",
            "foto_3"            => "IMG_20200317_161854397.jpg",
            "foto_4"            => "IMG_20200317_161859251.jpg",
            "foto_5"            => "IMG_20211022_202522222.jpg",
            "foto_6"            => NULL,
            "foto_7"            => NULL,
            "foto_8"            => NULL,
        ]);
    }
}
