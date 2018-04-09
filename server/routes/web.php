<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/Hello', function () use ($router) {
    return 'Hello Mother Fucker !';
});

$router->get('user/{id}', function ($id) {
    $result = app('db')->select("SELECT * FROM user WHERE id=1");;
    return $result[0]->name;
});