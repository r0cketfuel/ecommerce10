<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtributoArticulo extends Model
{
    protected $table    = "atributos_articulos";
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "articulo_id",
        "talle_id",
        "color",
        "compra_min",
        "compra_max",
        "stock",
        "imagen_id"
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function articulo()
    {
        return($this->belongsTo(Articulo::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function talle()
    {
        return($this->belongsTo(Talle::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function search(int $articulo_id, array $opciones = array())
    {
        //================================================================//
        // Método que devuelve registros segun los parámetros solicitados //
        //================================================================//
        
        $query = AtributoArticulo::query()->where("articulo_id",$articulo_id);
        
        //Relaciones
        $query->with("talle");

        foreach($opciones as $column => $value)
            if($value!=NULL)
                $query->where($column, $value);
        
        return($query->get());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function maximoCompra(int $articulo_id, array $opciones = array())
    {
        //===============================================================================================================//
        // Método que devuelve el máximo de compra de la combinación de un artículo según su stock o su límite de compra //
        //===============================================================================================================//
        
        $item = $this->search($articulo_id, $opciones)->first();

        if($item["compra_max"]!=NULL)
            if($item["compra_max"]<$item["stock"]) 
                return($item["compra_max"]); 
        
        return($item["stock"]);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function modificaStock(int $id, int $stock): array
    {
        if(self::where("id", $id)->update(["stock" => $stock]))
        {
            return(array(
                "success"   => true,
                "data"      => array(),
            ));
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}