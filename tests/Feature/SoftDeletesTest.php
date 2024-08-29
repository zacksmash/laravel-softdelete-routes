<?php

$dataset = [
    'restore' => fn () => [
        'methods' => ['PATCH'],
        'uri' => 'items/{item}/restore',
        'name' => 'items.restore',
        'action' => 'ItemController@restore',
    ],
    'erase' => fn () => [
        'methods' => ['DELETE'],
        'uri' => 'items/{item}/erase',
        'name' => 'items.erase',
        'action' => 'ItemController@erase',
    ],
];

it('it tests that softDeletes adds routes', function ($item) {
    $routes = buildRouteResource(
        fn ($resource) => $resource->softDeletes()
    );

    $route = $routes->getByName($item['name']);

    expect($route)->not->toBeNull();
    expect($route)->toBeInstanceOf(\Illuminate\Routing\Route::class);

    expect($route)->toUseMethod(implode(', ', $item['methods']));
    expect($route)->toHaveUri($item['uri']);
    expect($route)->toHaveRouteName($item['name']);
    expect($route)->toUseAction($item['action']);
    expect($route)->toLoadTrashed();

    // expect($route)->toLoadTrashed();
    // expect($route)->toUseParameter('thing');
    // expect($route)->toBeScopedBy('item', 'slug');
    // expect($route)->toHaveMiddleware('auth');
    // expect($route)->toBeWithoutMiddlware('auth');
})->with($dataset);

it('can be use a custom parameter', function ($item) {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->softDeletes()
            ->parameter('items', 'thing')
    );

    $uri = str_replace('{item}', '{thing}', $item['uri']);

    $route = $routes->getByName($item['name']);

    expect($route)->not->toBeNull();
    expect($route)->toBeInstanceOf(\Illuminate\Routing\Route::class);

    expect($route)->toUseMethod(implode(', ', $item['methods']));
    expect($route)->toHaveUri($uri);
    expect($route)->toHaveRouteName($item['name']);
    expect($route)->toUseAction($item['action']);
    expect($route)->toUseParameter('thing');
})->with($dataset);

it('can be scoped by a custom attribute', function ($item) {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->softDeletes()
            ->scoped(['item' => 'slug'])
    );

    $route = $routes->getByName($item['name']);

    expect($route)->not->toBeNull();
    expect($route)->toBeInstanceOf(\Illuminate\Routing\Route::class);

    expect($route)->toUseMethod(implode(', ', $item['methods']));
    expect($route)->toHaveUri($item['uri']);
    expect($route)->toHaveRouteName($item['name']);
    expect($route)->toUseAction($item['action']);
    expect($route)->toBeScopedBy('item', 'slug');
})->with($dataset);

it('can use middleware', function ($item) {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->softDeletes()
            ->middleware('auth')
    );

    $route = $routes->getByName($item['name']);

    expect($route)->not->toBeNull();
    expect($route)->toBeInstanceOf(\Illuminate\Routing\Route::class);

    expect($route)->toUseMethod(implode(', ', $item['methods']));
    expect($route)->toHaveUri($item['uri']);
    expect($route)->toHaveRouteName($item['name']);
    expect($route)->toUseAction($item['action']);
    expect($route)->toHaveMiddleware('auth');
})->with($dataset);

it('can ignore middleware', function ($item) {
    $routes = buildRouteResource(
        fn ($resource) => $resource
            ->softDeletes()
            ->middleware('auth')
            ->withoutMiddleware('auth')
    );

    $route = $routes->getByName($item['name']);

    expect($route)->not->toBeNull();
    expect($route)->toBeInstanceOf(\Illuminate\Routing\Route::class);

    expect($route)->toUseMethod(implode(', ', $item['methods']));
    expect($route)->toHaveUri($item['uri']);
    expect($route)->toHaveRouteName($item['name']);
    expect($route)->toUseAction($item['action']);
    expect($route)->toBeWithoutMiddlware('auth');
})->with($dataset);
