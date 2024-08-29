<?php

namespace Zacksmash\LaravelRouteActions\Routing;

use Illuminate\Routing\ResourceRegistrar as BaseRegistrar;

class ResourceRegistrar extends BaseRegistrar
{
    /**
     * Create a new resource registrar instance.
     */
    public function __construct(Router $router)
    {
        parent::__construct($router);

        self::$verbs = [
            'restore' => 'restore',
            'erase' => 'erase',
            ...parent::$verbs,
        ];
    }

    /**
     * Add a resource method to the resource defaults.
     */
    public function setResourceDefault(string $method): string
    {
        return $this->resourceDefaults[] = $method;
    }

    /**
     * Add the restore method for a resourceful route.
     */
    protected function addResourceRestore(string $name, string $base, string $controller, array $options): \Illuminate\Routing\Route
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name).'/{'.$base.'}/'.static::$verbs['restore'];

        $action = $this->getResourceAction($name, $controller, 'restore', $options);

        return $this->router->patch($uri, $action);
    }

    /**
     * Add the erase method for a resourceful route.
     */
    protected function addResourceErase(string $name, string $base, string $controller, array $options): \Illuminate\Routing\Route
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name).'/{'.$base.'}/'.static::$verbs['erase'];

        $action = $this->getResourceAction($name, $controller, 'erase', $options);

        return $this->router->delete($uri, $action);
    }
}
