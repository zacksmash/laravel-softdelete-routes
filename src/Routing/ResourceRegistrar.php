<?php

namespace Zacksmash\SoftDeleteRoutes\Routing;

use Illuminate\Routing\ResourceRegistrar as BaseRegistrar;

class ResourceRegistrar extends BaseRegistrar
{
    /**
     * Get or set the resource defaults used in resourcful controllers.
     *
     * @return array|void
     */
    public function resourceDefaults(?string $method = null)
    {
        if (! $method) {
            return $this->resourceDefaults;
        }

        $this->resourceDefaults[] = $method;
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
