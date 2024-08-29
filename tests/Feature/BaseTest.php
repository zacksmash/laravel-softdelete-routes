<?php

test('ensure routes function as normal', function () {
    $routes = buildRouteResource()->getRoutesByName();

    expect($routes)->toHaveKeys([
        'items.index',
        'items.create',
        'items.store',
        'items.show',
        'items.edit',
        'items.update',
        'items.destroy',
    ]);
});
