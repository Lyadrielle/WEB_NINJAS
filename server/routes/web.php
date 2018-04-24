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

$router->group(['prefix' => 'api'], function () use ($router) {

      $router->post('signin', 'UtilisateurController@signin');

      $router->post('signup', 'UtilisateurController@signup');

      $router->get('user', ['as' => 'home', 'middleware' => 'session', function (Illuminate\Http\Request $request) {
          $result = app('db')->select("SELECT * FROM utilisateur WHERE idutilisateur=:id", ["id" => $request->session()->get('utilisateur')]);
          return response()->json($result);
      }]);

      $router->get('admin', ['middleware' => 'auth', function () {
        return "Access granted !";
      }]);

      $router->get('logout', function () {
        app('session')->flush();
        return redirect('/');
      });

});
