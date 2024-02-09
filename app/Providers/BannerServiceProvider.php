<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Banner;

class BannerServiceProvider extends ServiceProvider
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
    public function boot(): void
    {
        view()->composer('shop.index', function($view)
        {
            // Obtener los Banners promocionales vigentes
            $banners = Banner::vigentes();

            $view->with(compact("banners"));
        });
    }
}
