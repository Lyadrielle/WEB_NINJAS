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

$router->post('api/signin', function(\Illuminate\Http\Request $request) {
    if ($request->isJson()) {
        $data = $request->json();
    } else {
        $data = $request;
    }

    $login = $data->get('login');
    $password = $data->get('password');
    
    $user = app('db')->select("SELECT * FROM user WHERE pseudonym='".$login."' AND password='".$password."'");

    if (!$user) {
        return response()->json(['success' => false, 'message' => 'wrong email or password']);
    }

    return response()->json(['success' => true, 'message' => 'test']);
});
