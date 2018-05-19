<?php

use Illuminate\Http\Request;
use App\Utilisateur;
use App\JSON;

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

          $router->post('action', ['middleware' => 'action', 'uses' => 'ExerciceController@createAction']);

           $router->post('skill', ['middleware' => 'action', 'uses' => 'ExerciceController@createSkills']);

          $router->post('mission', ['middleware' => 'action', 'uses' => 'MissionController@start']);

          $router->post('equipment', 'ObjetController@equip');

          $router->get('ninja', ['as' => 'home', function (Request $request) {
              $user = Utilisateur::where(["idutilisateur" => $request->session()->get('utilisateur')])->first();
              App\Http\Controllers\MissionController::check($user);
              App\Http\Controllers\ExerciceController::check($user);
              $user = Utilisateur::where(["idutilisateur" => $request->session()->get('utilisateur')])->first();

              return response()->json(JSON::user($user));
          }]);

          $router->get('createNinja/{name}', ['as' => 'ninja', 'uses' => 'NinjaController@create']);

		  $router->post('levelup', 'CompetenceController@addExp');

          $router->get('logout', function (Request $request) {
            $request->session()->flush();
            return redirect('/');
          });

      });



});
