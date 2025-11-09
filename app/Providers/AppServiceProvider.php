<?php

namespace App\Providers;

use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;

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
        FilamentFabricator::registerStyles([
           '<link href="'.asset('css/custom.css').'" rel="stylesheet">'
        ]);
        FilamentFabricator::registerScripts([
            '<script src="https://cdn.tailwindcss.com/3.4.16"></script>',
        ]);
    }
}
