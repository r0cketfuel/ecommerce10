<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Favorito;

class FavoritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Favorito::create([
            "usuario_id"    => 1,
            "articulo_id"   => 1,
            "fecha"         => date("Y-m-d H:i:s")
        ]);

        Favorito::create([
            "usuario_id"    => 1,
            "articulo_id"   => 2,
            "fecha"         => date("Y-m-d H:i:s")
        ]);

        Favorito::create([
            "usuario_id"    => 1,
            "articulo_id"   => 3,
            "fecha"         => date("Y-m-d H:i:s")
        ]);
    }
}
