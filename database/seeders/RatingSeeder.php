<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::create([
            "articulo_id"   => 1,
            "puntuaciones"  => 0,
            "sumatoria"     => 0,
            "stars"        => 0
        ]);
        
        Rating::create([
            "articulo_id"   => 2,
            "puntuaciones"  => 0,
            "sumatoria"     => 0,
            "stars"         => 0
        ]);

        Rating::create([
            "articulo_id"   => 3,
            "puntuaciones"  => 0,
            "sumatoria"     => 0,
            "stars"         => 0
        ]);

        Rating::create([
            "articulo_id"   => 4,
            "puntuaciones"  => 0,
            "sumatoria"     => 0,
            "stars"         => 0
        ]);

        Rating::create([
            "articulo_id"   => 5,
            "puntuaciones"  => 0,
            "sumatoria"     => 0,
            "stars"         => 0
        ]);

        Rating::create([
            "articulo_id"   => 6,
            "puntuaciones"  => 0,
            "sumatoria"     => 0,
            "stars"         => 0
        ]);
    }
}
