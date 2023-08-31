<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table    = "banners";
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "imagen",
        "descripcion",
        "link",
        "valido_desde",
        "valido_hasta"
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function vigentes()
    {
        //====================================================================================//
        // Método que retorna una colección con los banners promocionales vigentes a la fecha //
        //====================================================================================//

        return(Banner::all()->where("valido_desde","<=",date("Y-m-d H:i:s"))->where("valido_hasta",">=",date("Y-m-d H:i:s")));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}