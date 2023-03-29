<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/news';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        // if user's in DB then 404
        Route::bind('user',function ($value){
            return User::findOrFail($value);
        });

        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->namespace($this->namespace)
                ->group(base_path('routes/api_v1.php'));

            Route::middleware('api')
                ->prefix('api/v2')
                ->namespace($this->namespace)
                ->group(base_path('routes/api_v2.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        Route::middleware(['web','auth'])
            ->as('friends.')
            ->prefix('user')
            ->namespace($this->namespace)
            ->group(base_path('routes/friends.php'));


        Route::middleware('web')
            ->as('posts.')
            ->prefix('user')
            ->namespace($this->namespace)
            ->group(base_path('routes/posts.php'));
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
