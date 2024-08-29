<?php

namespace Zacksmash\LaravelRouteActions\Routing;

use Illuminate\Routing\Router as BaseRouter;

class Router extends BaseRouter
{
    /**
     * Create a new Router instance.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @param  \Illuminate\Contracts\Container\Container  $app
     * @return void
     */
    public function __construct($router, $app)
    {
        parent::__construct($app['events'], $app);

        foreach (get_object_vars($router) as $property => $value) {
            $this->$property = $value;
        }
    }

    /**
     * Route a resource to a controller.
     *
     * @param  string  $name
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\PendingResourceRegistration
     */
    public function resource($name, $controller, $options = [])
    {
        if ($this->container && $this->container->bound(ResourceRegistrar::class)) {
            $registrar = $this->container->make(ResourceRegistrar::class);
        } else {
            $registrar = new ResourceRegistrar($this);
        }

        return new PendingResourceRegistration(
            $registrar, $name, $controller, $options
        );
    }
}
