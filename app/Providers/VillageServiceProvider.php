<?php

namespace App\Providers;

use App\Models\Village;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class VillageServiceProvider extends ServiceProvider
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
        // Share village info with all views
        View::composer('*', function ($view) {
            $village = Village::getMainVillage();
            $view->with('villageInfo', $village);
        });
    }
}
