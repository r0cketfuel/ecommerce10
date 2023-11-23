<?php

namespace App\Models;

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
        "valido_hasta",
        "eliminado"
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function vigentes()
    {
        //====================================================================================//
        // Método que retorna una colección con los banners promocionales vigentes a la fecha //
        //====================================================================================//

        $banners = Banner::where("valido_desde", "<=", now())->where("valido_hasta", ">=", now())->where("eliminado", False)->get();

        // Agregar rutas de imágenes según configuración
        foreach ($banners as $banner)
        {
            $banner->imagen = config("constants.banners") . '/' . $banner->imagen;
        }
    
        return $banners;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}