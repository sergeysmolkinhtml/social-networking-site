<?php

namespace App\Providers;

use App\Http\Resources\GroupResource;
use App\Models\User;
use App\Observers\UserObserver;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        GroupResource::withoutWrapping();
        Filament::serving(function (){
            Filament::registerViteTheme('resources/css/filament.css');
        });
        /*User::observe(UserObserver::class);*/
    }
}
