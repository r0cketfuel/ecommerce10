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
        "foto_8",
        "activo"
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function atributos()
    {
        //=============================================================//
        // Relación artículos[id] con atributos_articulos[articulo_id] //
        //=============================================================//
        return $this->hasMany(AtributoArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function categoria()
    {
        //====================================================//
        // Relación artículos[categoria_id] -> categorias[id] //
        //====================================================//
        return($this->belongsTo(Categoria::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function subcategoria()
    {
        //==========================================================//
        // Relación artículos[subcategoria_id] -> subcategorias[id] //
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
            
            if($articulo)
            {
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
        }
        
        return(null);
	}    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	public static function search(array $search)
	{
        //=============================================//
        // Método que devuelve un listado de artículos //
        //=============================================//

        $query = Articulo::where("estado", 1)->where("activo", True);

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
    
        if(isset($search["subcategoria"]))
            $query->where("subcategoria_id", $search["subcategoria"]);

        if(isset($search["orderby"]))
            $query->orderBy($search["orderby"], "ASC");
            
        return($query->paginate(config("constants.pagination")));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function incrementaVisualizacion(int $id): int
    {
        $articulo = self::find($id);
        $articulo->increment('visualizaciones');
        $articulo->save();

        return $articulo->visualizaciones;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function eliminaArticulo(int $id): int
    {
        $articulo = self::find($id);
    
        if($articulo)
        {
            $articulo->update(['activo' => false]);
    
            return(1);
        }
    
        return(0);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}