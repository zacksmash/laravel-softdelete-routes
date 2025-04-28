<?php

namespace Zacksmash\SoftDeleteRoutes;

use Illuminate\Routing\ResourceRegistrar;

class RegisterRoute
{
    public static function with(string|array $action, ResourceRegistrar $registrar): void
    {
        $actions = is_array($action) ? $action : [$action];
        $registrar = invade($registrar);

        $registrar->verbs(array_combine($actions, $actions));

        $registrar->resourceDefaults = array_merge(
            $registrar->resourceDefaults, $actions
        );
    }
}
