<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administrador;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrador::create([
            "username"  => "devadmin",
            "password"  => "12345678",
            "apellidos" => "apellido",
            "nombres"   => "nombre",
            "rol_id"    => 1,
            "estado"    => "1",
            "alta"      => date("Y-m-d H:i:s"),
        ]);

        Administrador::create([
            "username"  => "admin",
            "password"  => "12345678",
            "apellidos" => "apellido",
            "nombres"   => "nombre",
            "rol_id"    => 2,
            "estado"    => "1",
            "alta"      => date("Y-m-d H:i:s"),
        ]);
    }
}
