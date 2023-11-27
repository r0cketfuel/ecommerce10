<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedioEnvio extends Model
{
    protected $table    = 'medios_envios';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'medio',
        'costo',
        'estado'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function activos()
    {
        return(self::where('estado', 1)->get());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function costo($id)
    {
        return(self::find($id)['costo']);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
