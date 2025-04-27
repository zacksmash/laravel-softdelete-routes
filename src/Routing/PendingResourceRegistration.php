<?php

namespace Zacksmash\SoftDeleteRoutes\Routing;

use Illuminate\Routing\PendingResourceRegistration as BasePendingResourceRegistration;

class PendingResourceRegistration extends BasePendingResourceRegistration
{
    /**
     * Add a restore method to the resource.
     */
    public function withRestore(): self
    {
        $this->registrar->verbs(['restore' => 'restore']);

        $this->registrar->resourceDefaults('restore');

        $this->options['trashed']['restore'] = true;

        return $this;
    }

    /**
     * Add a erase method to the resource.
     */
    public function withErase(): self
    {
        $this->registrar->verbs(['erase' => 'erase']);

        $this->registrar->resourceDefaults('erase');

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
