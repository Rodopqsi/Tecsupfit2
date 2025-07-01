<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Objetivo;
use App\Models\Tamano;
use App\Models\Sabor;
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
        // Forzar HTTPS en producción
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        
        View::composer('*', function ($view) {
        $view->with('categorias', Categoria::all());
        $view->with('marcas', Marca::all());
        $view->with('objetivos', Objetivo::all());
        $view->with('tamanos', Tamano::all());
        $view->with('sabores', Sabor::all());
    });
    }
}
