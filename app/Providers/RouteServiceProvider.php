<?php

namespace App\Providers;

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
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware(['api', 'Api_Secret_Key'])
                ->prefix('api/v1')
                ->group(base_path('routes/api/api_v1.php'));
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            //Admins Routes
            Route::middleware(['web', 'auth:admin'])
                ->prefix('admin')
                ->group(base_path('routes/admins/admin.php'));

            Route::middleware(['web', 'auth:admin'])
                ->prefix('owner')
                ->group(base_path('routes/admins/owner.php'));

            Route::middleware(['web', 'auth:admin'])
                ->prefix('pos')
                ->group(base_path('routes/admins/pos.php'));

        });
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
