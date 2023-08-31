<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoComercio extends Model
{
    protected $table    = "info_comercio";
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "nombre",
        "slogan",
        "descripcion",
        "cuit",
        "direccion",
        "entre_calles_1",
        "entre_calles_2",
        "codigo_postal",
        "local",
        "barrio",
        "localidad",
        "provincia",
        "pais",
        "telefono_1",
        "telefono_2",
        "fax",
        "email",
        "geolocalizacion",
        "facebook",
        "instagram",
        "twitter",
        "pinterest"
    ];

}