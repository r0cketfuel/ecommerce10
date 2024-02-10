<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Request $request): void // Asegúrate de incluir Request como parámetro
    {
        view()->composer('shop.item.rating', function($view) use ($request) // Pasa $request al callback usando use()
        {
            // Obtener el $id del artículo de la ruta
            $id = $request->route('id');

            // Obtener las calificaciones del artículo
            $ratings = Rating::find($id);

            // Incrementar las visualizaciones del artículo
            Rating::incrementaVisualizacion($id);

            // Pasar las estadísticas y calificaciones del artículo a la vista
            $view->with(compact("ratings"));
        });
    }
}
