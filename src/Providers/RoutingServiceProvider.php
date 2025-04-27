<?php

namespace Zacksmash\SoftDeleteRoutes\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->extend(Router::class, function (Router $router, Application $app) {
            return new \Zacksmash\SoftDeleteRoutes\Routing\Router($router, $app);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
