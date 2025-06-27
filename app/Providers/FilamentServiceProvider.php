<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Filament::serving(function () {
        //     Filament::registerUserMenuItems([
        //         UserMenuItem::make()
        //             ->label('Logout')
        //             ->url(route('filament.admin.auth.logout'))
        //             ->icon('heroicon-o-arrow-right-on-rectangle')
        //             ->sort(10),
        //     ]);
        // });
    }

    public function register(): void
    {
        //
    }
}
