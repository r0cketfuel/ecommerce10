<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "codigo",
        "nombre",
        "descripcion",
        "precio",
        "moneda",
        "categoria_id",
        "subcategoria_id",
        "estado",
        "visualizaciones",
        "foto_1",
        "foto_2",
        "foto_3",
        "foto_4",
        "foto_5",
        "foto_6",
        "foto_7",
        "foto_8"
    ];
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function atributos()
    {
        //=============================================================//
        // Relación articulos[id] con atributos_articulos[articulo_id] //
        //=============================================================//
        return $this->hasMany(AtributoArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function categoria()
    {
        //====================================================//
        // Relación articulos[categoria_id] -> categorias[id] //
        //====================================================//
        return($this->belongsTo(Categoria::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function subcategoria()
    {
        //==========================================================//
        // Relación articulos[subcategoria_id] -> subcategorias[id] //
        //==========================================================//
        return($this->belongsTo(Subcategoria::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	public static function info(int $id)
	{
        //=========================================================//
        // FUNCION QUE DEVUELVE LA INFORMACION BASICA DEL ARTICULO //
        //=========================================================//
        if($id>0)
        {
            //Datos de la tabla
            $articulo = Articulo::where("id",$id)->where("estado",1)->first();
            
            //Agregado de rutas de imágenes según configuracíon y atributo miniaturas
            for($i=1;$i<=8;$i++)
            {
                $foto       = "foto_"       . $i;
                $miniatura  = "miniatura_"  . $i;
                if($articulo->$foto !== NULL)
                {
                    $articulo->$miniatura   = config("constants.product_images") . "/" . $id . "/thumbs/" . $articulo->$foto;
                    $articulo->$foto        = config("constants.product_images") . "/" . $id . "/"        . $articulo->$foto;
                }
                else
                {
                    $articulo->$miniatura   = config("constants.product_images") . "/no-image.png";
                    $articulo->$foto        = config("constants.product_images") . "/no-image.png";                    
                }
            }
            
            return($articulo);
        }
        
        return(null);
	}    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	public static function search(array $search)
	{
        //=============================================//
        // Método que devuelve un listado de artículos //
        //=============================================//

        $query = Articulo::where("estado", 1);

        if(isset($search["query"]))
        {
            $query->where(function ($q) use ($search)
            {
                $q->where("codigo",         "like", "%" . $search["query"] . "%")
                ->orWhere("nombre",         "like", "%" . $search["query"] . "%")
                ->orWhere("descripcion",    "like", "%" . $search["query"] . "%");
            });
        }
    
        if(isset($search["categoria"]))
            $query->where("categoria_id", $search["categoria"]);
    
        if (isset($search["subcategoria"]))
            $query->where("subcategoria_id", $search["subcategoria"]);
    
        return($query->paginate(config("constants.pagination")));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

}