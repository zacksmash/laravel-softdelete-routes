<?php

namespace Zacksmash\LaravelRouteActions\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->extend(Router::class, function (Router $router, Application $app) {
            return new \Zacksmash\LaravelRouteActions\Routing\Router($router, $app);
        });
    }
}
