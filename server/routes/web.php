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

      $router->post('signin', 'UtilisateurController@signin');

      $router->post('signup', 'UtilisateurController@signup');

      $router->group(['middleware' => 'auth'], function () use ($router) {

          $router->get('action/{action}', ['middleware' => 'action', 'uses' => 'ExerciceController@create']);

          $router->get('update/exercice', ['as' => 'updateExo', 'uses' => 'ExerciceController@update']);
		  
		   $router->get('mission/{idmrealisee}', ['middleware' => 'action', 'uses' => 'MissionController@create']);

          $router->get('game', ['as' => 'home', function (Request $request) {
              $user = Utilisateur::where(["idutilisateur" => $request->session()->get('utilisateur')])->first();
              if(empty($user->idninja)) {
                return redirect()->route('ninja', ['name' => 'Alberto']);
              }
              if(!empty($user->ninja->exercices->where('statut', '=', 2)->first())) {
                return redirect()->route('updateExo');
              }

              return response()->json($user->get());
          }]);

          $router->get('createNinja/{name}', ['as' => 'ninja', 'uses' => 'NinjaController@create']);
		  
		  $router->post('levelup', 'CompetenceController@addExp');

          $router->get('logout', function (Request $request) {
            $request->session()->flush();
            return redirect('/');
          });

      });



});
