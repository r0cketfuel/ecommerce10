<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table    = "reviews";
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "usuario_id",
        "articulo_id",
        "fecha",
        "hora",
        "titulo",
        "texto",
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function usuario()
    {
        //======================================//
        // Relación usuario_id con usuarios[id] //
        //======================================//
        return($this->belongsTo(Usuario::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function reviews(int $id)
    {
        //======================================================//
        // Método que carga todas las reviews sobre un articulo //
        //======================================================//
        return(self::with("usuario")->where("articulo_id", $id)->get());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
}