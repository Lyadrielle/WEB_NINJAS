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

$router->get('/', ['as' => 'test', function () use ($router) {
    return $router->app->version();
}]);

$router->group(['prefix' => 'api'], function () use ($router) {


      $router->group(['middleware' => 'session'], function () use ($router) {

          $router->post('signin', 'UtilisateurController@signin');

          $router->post('signup', 'UtilisateurController@signup');

      });

      $router->group(['middleware' => 'auth'], function () use ($router) {

          $router->get('action/{action}', ['middleware' => 'action', 'uses' => 'ExerciceController@create']);

		      $router->get('update', function() {
            $user = Utilisateur::where(["idutilisateur" => $request->session()->get('utilisateur')])->first();
            App\Http\Controllers\MissionController::check($user);
            App\Http\Controllers\ExerciceController::check($user);

            return redirect()->route('home');
          });

          $router->get('game', ['as' => 'home', function (Request $request) {
              $user = Utilisateur::where(["idutilisateur" => $request->session()->get('utilisateur')])->first();
              if(empty($user->idninja)) {
                return redirect()->route('ninja', ['name' => 'Alberto']);
              }

              return response()->json($user);
          }]);

          $router->get('createNinja/{name}', ['as' => 'ninja', 'uses' => 'NinjaController@create']);

		  $router->post('levelup', 'CompetenceController@addExp');

          $router->get('logout', function (Request $request) {
            $request->session()->flush();
            return redirect('/');
          });

      });



});
