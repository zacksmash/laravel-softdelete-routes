<?php

namespace Zacksmash\LaravelRouteActions\Routing;

use Illuminate\Routing\PendingResourceRegistration as BasePendingResourceRegistration;

class PendingResourceRegistration extends BasePendingResourceRegistration
{
    /**
     * Create a new pending resource registration instance.
     *
     * @param  \Illuminate\Routing\ResourceRegistrar  $registrar
     * @param  string  $name
     * @param  string  $controller
     * @return void
     */
    public function __construct($registrar, $name, $controller, array $options)
    {
        parent::__construct($registrar, $name, $controller, $options);
    }

    /**
     * Add a restore method to the resource.
     */
    public function withRestore(): self
    {
        $this->registrar->setResourceDefault('restore');

        $this->options['trashed']['restore'] = true;

        return $this;
    }

    /**
     * Add a erase method to the resource.
     */
    public function withErase(): self
    {
        $this->registrar->setResourceDefault('erase');

        $this->options['trashed']['erase'] = true;

        return $this;
    }

    /**
     * Add soft deletes to the resource.
     */
    public function softDeletes()
    {
        $this->withRestore();
        $this->withErase();

        return $this;
    }
}
