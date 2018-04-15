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

      $router->post('signin', function (Illuminate\Http\Request $request) {
          $method = $request->method();

          $result = array();

          if($request->isMethod('post') && $request->has('pseudo') && $request->has('mdp')) {

            $pseudo = $request->input('pseudo');
            $mdp = $request->input('mdp');

            $check = app('db')->select("SELECT idutilisateur FROM utilisateur WHERE pseudo = :pseudo AND motdepasse = :mdp", ["pseudo" => $pseudo, "mdp" => sha1($mdp)]);

            if(count($check) == 0) {
              $result['error'] = 'Incorrect Ids';
              $result['code'] = 2;
              $result['pseudo'] = $pseudo;
              return response()->json($result);
            } else {

              $result['id'] = $check[0]->idutilisateur;

              return redirect()->route('home', $result);
            }

          } else {

            $result['error'] = 'Forbidden';
            $result['code'] = 403;
            return response()->json($result);

          }

      });

      $router->post('signup', function (Illuminate\Http\Request $request) {
          $method = $request->method();

          $result = array();

          if($request->isMethod('post') && $request->has('pseudo') && $request->has('mdp')) {

            $pseudo = $request->input('pseudo');

            $check = app('db')->select("SELECT pseudo FROM utilisateur WHERE pseudo = :pseudo", ["pseudo" => $pseudo]);


            if(count($check) > 0) {
              $result['error'] = 'Pseudo Already Existing';
              $result['code'] = 1;
              $result['pseudo'] = $pseudo;
              return response()->json($result);
            }

            $mdp = $request->input('mdp');

            $insert = app('db')->insert("INSERT INTO utilisateur (pseudo, motdepasse) VALUES (:pseudo, :mdp)", ["pseudo" => $pseudo, "mdp" => sha1($mdp)]);

            $check = app('db')->select("SELECT idutilisateur FROM utilisateur WHERE pseudo = :pseudo", ["pseudo" => $pseudo]);

            $result['id'] = (string) $check[0]->idutilisateur;

            return redirect()->route('home', $result);

          } else {

            $result['error'] = 'Forbidden';
            $result['code'] = 403;
            return response()->json($result);

          }

      });

      $router->get('user/{id}', ['as' => 'home', function ($id) {
          $result = app('db')->select("SELECT * FROM utilisateur WHERE idutilisateur=:id", ["id" => $id]);
          return response()->json($result);
      }]);

});
