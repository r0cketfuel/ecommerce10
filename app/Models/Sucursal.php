<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table    = "sucursales";
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'nombre',
        'direccion',
        'entre_calles_1',
        'entre_calles_2',
        'codigo_postal',
        'local',
        'barrio',
        'localidad',
        'provincia',
        'pais',
        'telefono_1',
        'telefono_2',
        'fax',
        'email',
        'geolocalizacion',
        'principal',
        "eliminado",
    ];
}
