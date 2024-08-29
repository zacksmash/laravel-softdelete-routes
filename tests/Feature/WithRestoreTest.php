<?php

it('adds a restore action route to the routes list', function () {
    $routes = buildRouteResource(
        fn ($resource) => $resource->withRestore()
    );

    $route = $routes->getByName('items.restore');

    expect($route)->toUseMethod('PATCH');
    expect($route)->toHaveUri('items/{item}/restore');
    expect($route)->toHaveRouteName('items.restore');
    expect($route)->toUseAction('ItemController@restore');
});

it('adds a restore action route and inherits the named routes', function () {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->names([
                'restore' => 'items.lets-restore',
            ])
            ->withRestore()
    );

    $route = $routes->getByName('items.lets-restore');

    expect($route)->toUseMethod('PATCH');
    expect($route)->toHaveUri('items/{item}/restore');
    expect($route)->toHaveRouteName('items.lets-restore');
    expect($route)->toUseAction('ItemController@restore');
});

it('adds a restore action route and inherits the custom parameter name', function () {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->parameter('items', 'thing')
            ->withRestore()
    );

    $route = $routes->getByName('items.restore');

    expect($route)->toUseMethod('PATCH');
    expect($route)->toHaveUri('items/{thing}/restore');
    expect($route)->toHaveRouteName('items.restore');
    expect($route)->toUseAction('ItemController@restore');
    expect($route)->toUseParameter('thing');
});

it('adds a restore action route with nested resources', function () {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->withRestore(),
        resource: 'companies.users.items'
    );

    $route = $routes->getByName('companies.users.items.restore');

    expect($route)->toUseMethod('PATCH');
    expect($route)->toHaveUri('companies/{company}/users/{user}/items/{item}/restore');
    expect($route)->toHaveRouteName('companies.users.items.restore');
    expect($route)->toUseAction('ItemController@restore');
});

it('adds a restore action route with shallow nested resources', function () {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->shallow()
            ->withRestore(),
        resource: 'companies.users.items'
    );

    $route = $routes->getByName('items.restore');

    expect($route)->toUseMethod('PATCH');
    expect($route)->toHaveUri('items/{item}/restore');
    expect($route)->toHaveRouteName('items.restore');
    expect($route)->toUseAction('ItemController@restore');
});
