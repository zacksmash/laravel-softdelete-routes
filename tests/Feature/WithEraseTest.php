<?php

it('adds an erase action route to the routes list', function () {
    $routes = buildRouteResource(
        fn ($resource) => $resource->withErase()
    );

    $route = $routes->getByName('items.erase');

    expect($route)->toUseMethod('DELETE');
    expect($route)->toHaveUri('items/{item}/erase');
    expect($route)->toHaveRouteName('items.erase');
    expect($route)->toUseAction('ItemController@erase');
});

it('adds an erase action route and inherits the named routes', function () {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->names([
                'erase' => 'items.lets-erase',
            ])
            ->withErase()
    );

    $route = $routes->getByName('items.lets-erase');

    expect($route)->toUseMethod('DELETE');
    expect($route)->toHaveUri('items/{item}/erase');
    expect($route)->toHaveRouteName('items.lets-erase');
    expect($route)->toUseAction('ItemController@erase');
});

it('adds an erase action route and inherits the custom parameter name', function () {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->parameter('items', 'thing')
            ->withErase()
    );

    $route = $routes->getByName('items.erase');

    expect($route)->toUseMethod('DELETE');
    expect($route)->toHaveUri('items/{thing}/erase');
    expect($route)->toHaveRouteName('items.erase');
    expect($route)->toUseAction('ItemController@erase');
    expect($route)->toUseParameter('thing');
});

it('adds an erase action route with nested resources', function () {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->withErase(),
        resource: 'companies.users.items'
    );

    $route = $routes->getByName('companies.users.items.erase');

    expect($route)->toUseMethod('DELETE');
    expect($route)->toHaveUri('companies/{company}/users/{user}/items/{item}/erase');
    expect($route)->toHaveRouteName('companies.users.items.erase');
    expect($route)->toUseAction('ItemController@erase');
});

it('adds an erase action route with shallow nested resources', function () {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->shallow()
            ->withErase(),
        resource: 'companies.users.items'
    );

    $route = $routes->getByName('items.erase');

    expect($route)->toUseMethod('DELETE');
    expect($route)->toHaveUri('items/{item}/erase');
    expect($route)->toHaveRouteName('items.erase');
    expect($route)->toUseAction('ItemController@erase');
});
