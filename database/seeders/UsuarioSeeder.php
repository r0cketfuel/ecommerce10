<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::create([
            "username"                  => "usuario",
            "password"                  => "12345678",
            "apellidos"                 => "Apellido",
            "nombres"                   => "Nombres",
            "tipo_documento_id"         => 1,
            "documento_nro"             => "12345678",
            "cuit"                      => NULL,
            "cuil"                      => "20123456782",
            "fecha_nacimiento"          => "1985-01-04",
            "genero_id"                 => 2,
            "domicilio"                 => "Domicilio",
            "domicilio_nro"             => "1234",
            "domicilio_piso"            => "PB",
            "domicilio_depto"           => "2",
            "domicilio_aclaraciones"    => "Timbre del medio",
            "localidad"                 => "Bahía Blanca",
            "codigo_postal"             => "8000",
            "telefono_fijo"             => NULL,
            "telefono_celular"          => "2912345678",
            "telefono_alt"              => NULL,
            "email"                     => "usuariodeprueba@hotmail.com",
            "estado"                    => 1,
            "creado"                    => "2022-11-25",
        ]);

        for($i=0;$i<5;$i++)
        {
            Usuario::create([
                "username"                  => "usuario$i",
                "password"                  => "12345678",
                "apellidos"                 => "Apellido$i",
                "nombres"                   => "Nombres$i",
                "tipo_documento_id"         => 1,
                "documento_nro"             => "0000000$i",
                "cuit"                      => NULL,
                "cuil"                      => NULL,
                "fecha_nacimiento"          => "1985-01-04",
                "genero_id"                 => 2,
                "domicilio"                 => "Domicilio",
                "domicilio_nro"             => "1234",
                "domicilio_piso"            => "PB",
                "domicilio_depto"           => "2",
                "domicilio_aclaraciones"    => "Puerta de rejas negras",
                "localidad"                 => "Bahía Blanca",
                "codigo_postal"             => "8000",
                "telefono_fijo"             => NULL,
                "telefono_celular"          => "2912345678",
                "telefono_alt"              => NULL,
                "email"                     => "usuario$i@hotmail.com",
                "estado"                    => 1,
                "creado"                    => "2022-11-25",
            ]);
        }
    }
}
