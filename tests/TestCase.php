<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Zacksmash\LaravelRouteActions\Providers\RoutingServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            RoutingServiceProvider::class,
        ];
    }
}
