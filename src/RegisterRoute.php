<?php

namespace Zacksmash\SoftDeleteRoutes;

class RegisterRoute
{
    public static function with($action, $registrar)
    {
        $registrar = invade($registrar);

        $registrar->verbs([$action => $action]);

        $registrar->resourceDefaults = array_merge(
            $registrar->resourceDefaults, [$action => $action]
        );
    }
}
