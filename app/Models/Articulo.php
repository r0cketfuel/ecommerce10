<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

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
        "activo"
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function atributos()
    {
        return $this->hasMany(AtributoArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function categoria()
    {
        return($this->belongsTo(Categoria::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function subcategoria()
    {
        return($this->belongsTo(Subcategoria::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function imagenes()
    {
        return $this->hasMany(ImagenArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function info(int $id)
    {
        if($id > 0)
        {
            $articulo = Articulo::where("id", $id)->where("estado", 1)->with('imagenes')->first();
    
            if($articulo)
            {
                foreach ($articulo->imagenes as $imagen)
                {
                    $imagen->miniatura  = config("constants.product_images") . "/" . $id . "/thumbs/"   . $imagen->ruta;
                    $imagen->ruta       = config("constants.product_images") . "/" . $id . "/"          . $imagen->ruta;
                }
    
                return $articulo;
            }
        }
    
        return null;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	public static function search(array $search)
	{
        //=============================================//
        // Método que devuelve un listado de artículos //
        //=============================================//

        $query = Articulo::where("estado", 1)->where("activo", True)->with('imagenes');

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

        if(isset($search["sort"]))
            if(isset($search["order"]))
                $query->orderBy($search["sort"], $search["order"]);
        
        $items = $query->paginate(config("constants.pagination"));

        foreach ($items as $item) {
            if ($item->imagenes->isNotEmpty()) {
                foreach ($item->imagenes as $imagen) {
                    $imagen->miniatura  = asset(config("constants.product_images") . "/" . $item->id . "/thumbs/"   . $imagen->ruta);
                    $imagen->ruta       = asset(config("constants.product_images") . "/" . $item->id . "/"          . $imagen->ruta);
                }
            }
        }
    
        return $items;
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function incrementaVisualizacion(int $id): int
    {
        try
        {
            $articulo = self::findOrFail($id);
            $articulo->increment('visualizaciones');
            return $articulo->visualizaciones;
        }
        catch (ModelNotFoundException $e)
        {
            throw new \Exception(trans('messages.articulo_not_found'));
        }
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