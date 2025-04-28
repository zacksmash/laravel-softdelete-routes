<?php

namespace Zacksmash\SoftDeleteRoutes;

use Illuminate\Routing\ResourceRegistrar;

class RegisterRoute
{
    public static function with(string|array $action, ResourceRegistrar $registrar): void
    {
        $actions = is_array($action) ? $action : [$action];
        $registrar = invade($registrar);

        $defaultVerbs = $registrar->verbs();

        $registrar->verbs(
            $defaultVerbs + array_diff_key(
                array_combine($actions, $actions), $defaultVerbs
            )
        );

        $registrar->resourceDefaults = array_merge(
            $registrar->resourceDefaults, $actions
        );
    }
}
