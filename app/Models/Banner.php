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
        "valido_hasta",
        "activo"
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function vigentes()
    {
        //====================================================================================//
        // Método que retorna una colección con los banners promocionales vigentes a la fecha //
        //====================================================================================//

        $banners = Banner::where("valido_desde", "<=", date("Y-m-d H:i:s"))->where("valido_hasta", ">=", date("Y-m-d H:i:s"))->where("activo", True)->get();
    
        // Agregar rutas de imágenes según configuración
        foreach ($banners as $banner) {
            $banner->imagen = config("constants.banners") . '/' . $banner->imagen;
        }
    
        return $banners;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function detalle($id)
    {
        //=====================================================//
        // Método que retorna el detalle completo de un banner //
        //=====================================================//

        return(Banner::where('id', $id)->first());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}