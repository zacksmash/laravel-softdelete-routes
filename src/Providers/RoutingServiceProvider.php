<?php

namespace Zacksmash\SoftDeleteRoutes\Providers;

use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;
use Illuminate\Support\ServiceProvider;
use Zacksmash\SoftDeleteRoutes\RegisterRoute;
use Zacksmash\SoftDeleteRoutes\ResourceRegistrar;

class RoutingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseResourceRegistrar::class, ResourceRegistrar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        PendingResourceRegistration::macro('withRestore', function () {
            RegisterRoute::with('restore', $this->registrar);

            return $this;
        });

        PendingResourceRegistration::macro('withErase', function () {
            RegisterRoute::with('erase', $this->registrar);

            return $this;
        });

        PendingResourceRegistration::macro('softDeletes', function () {
            $this->withRestore();
            $this->withErase();

            return $this;
        });
    }
}
