<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
        //Model::preventLazyLoading(! $this->app->isProduction());

        if (App::environment('local')) {
            DB::listen(function($query) {
                File::append(
                    storage_path('/logs/query.log'),
                    '[' . date('Y-m-d H:i:s') . ']' . PHP_EOL . $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL . PHP_EOL
                );
            });
        }
    }
}
