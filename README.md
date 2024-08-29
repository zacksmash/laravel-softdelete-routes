# Laravel Soft Delete Routes
[![Tests](https://github.com/zacksmash/laravel-softdelete-routes/actions/workflows/tests.yml/badge.svg)](https://github.com/zacksmash/laravel-softdelete-routes/actions/workflows/tests.yml)

## Intro
This package gives you some helper methods on route resources to handle extra actions for restoring and force deleting a model.

```php
// routes/web.php

Route::resource('items', ItemController::class)
    ->softDeletes();

// Or individually, if you only need one
Route::resource('items', ItemController::class)
    ->withRestore()
    ->withErase()
```

This will give you the standard route resource methods, but you'll also get:

```bash
# standard routes...
PATCH           items/{item}/restore ..... items.restore › ItemController@restore
DELETE          items/{item}/erase ......... items.erase › ItemController@erase
```
