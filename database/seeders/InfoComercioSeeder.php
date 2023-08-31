<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\InfoComercio;

class InfoComercioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InfoComercio::create([
            "nombre"            => "Nombre del comercio",
            "slogan"            => "Slogan del comercio",
            "descripcion"       => "Descripción del comercio",
            "telefono_1"        => "1234567890",
            "email"             => "correodeprueba@hotmail.com",
            "geolocalizacion"   => "",
            "direccion"         => "Dirección",
            "entre_calles_1"    => "Calle 1",
            "entre_calles_2"    => "Calle 2",
            "localidad"         => "Localidad",
            "provincia"         => "Provincia",
            "facebook" 	        => "https://www.facebook.com",
            "twitter" 	        => "https://www.twitter.com",
            "instagram"     	=> "https://www.instagram.com",
            "pinterest" 	    => "https://www.pinterest.com",
        ]);
    }
}
