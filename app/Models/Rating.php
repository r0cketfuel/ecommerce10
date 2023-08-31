<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "articulo_id",
        "puntuaciones",
        "sumatoria",
        "stars"
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function getRatingArticulo(int $id)
    {
        $rating = self::find($id);
        $rating->promedio = self::promedio($rating->sumatoria, $rating->puntuaciones);

        return($rating);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function setRatingArticulo(int $id, int $puntuacion)
    {
        $productRating = self::find($id);

        $productRating->puntuaciones += 1;
        $productRating->sumatoria += $puntuacion;
        $productRating->stars = ($productRating->sumatoria + $puntuacion) / ($productRating->puntuaciones + 1);
        
        $productRating->save();
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    private static function promedio($sumatoria, $puntuaciones)
    {
        $promedio = 0;
        if($puntuaciones>0)
            $promedio = $sumatoria / $puntuaciones;
        
        return(number_format($promedio, 2, ",", "."));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

}
