<?php

use Illuminate\Http\Request;
use App\Utilisateur;

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

      $router->group(['middleware' => 'auth'], function () use ($router) {

          $router->get('action/{action}', ['middleware' => 'action', 'ExerciceController@create']);

          $router->get('game', ['as' => 'home', function (Request $request) {
              $user = Utilisateur::where(["id" => $request->session()->get('utilisateur')]);
              if(empty($user->idninja)) {
                return redirect()->route('createNinja', ['name' => 'Alberto']);
              }
              return response()->json($user);
          }]);

          $router->post('createNinja/{name}', ['as' => 'ninja', 'NinjaController@create']);

          $router->get('logout', function (Request $request) {
            $request->session()->flush();
            return redirect('/');
          });

      });



});
