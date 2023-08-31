<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\InfoComercioService;

use App\Models\Categoria;
use App\Models\Subcategoria;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $infoComercio   = new InfoComercioService();
        $info           = $infoComercio->info();

        view()->composer('*', function($view)
        {
            $categorias     = Categoria::all();
            $subcategorias  = Subcategoria::all();
            $view->with(compact("categorias", "subcategorias"));
        });
    }
}
