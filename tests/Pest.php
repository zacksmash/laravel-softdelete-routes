<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toUseMethod', function (...$methods) {
    if (count($methods) === 1) {
        return expect($this->value->methods())->toContain($methods[0]);
    }

    return expect($this->value->methods())->toBe($methods);
});

expect()->extend('toHaveUri', function ($uri) {
    return expect($this->value->uri())->toBe($uri);
});

expect()->extend('toHaveRouteName', function ($name) {
    return expect($this->value->getName())->toBe($name);
});

expect()->extend('toUseAction', function ($action) {
    return expect($this->value->getActionName())->toBe($action);
});

expect()->extend('toHaveMiddleware', function ($middleware) {
    return expect($this->value->getAction()['middleware'] ?? [])->toContain($middleware);
});

expect()->extend('toBeWithoutMiddlware', function ($middleware) {
    return expect($this->value->getAction()['excluded_middleware'] ?? [])->toContain($middleware);
});

expect()->extend('toUseParameter', function ($parameter) {
    return expect($this->value->parameterNames())->toContain($parameter);
});

expect()->extend('toBeScopedBy', function ($original, $scoped) {
    return expect($this->value->bindingFields()[$original] ?? null)->toBe($scoped);
});

expect()->extend('toLoadTrashed', function () {
    // dd($this->value);
    // return expect($this->value->getAction()['withTrashed'] ?? false)->toBeTrue();
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

// make a controller for the test

function buildRouteResource(?callable $callback = null, ?string $resource = 'items')
{
    // create a route resource with a prefix
    $resource = Route::resource($resource, ItemController::class);

    // call the callback if it exists
    if ($callback) {
        $callback($resource);
    }

    // return the routes
    return Route::getRoutes();
}
