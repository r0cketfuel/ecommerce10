<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedioPago extends Model
{
    protected $table    = "medios_pagos";
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "medio",
        "estado"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function activos()
    {
        return(self::where("estado", 1)->get());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
