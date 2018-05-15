<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ninja;

use App\Utilisateur;

use App\Competence;

class NinjaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    //

    public function create(Request $request, $name) {

      $user = Utilisateur::where('idutilisateur', $request->session()->get('utilisateur'))->first();

      if(empty($user->idninja)) {

        if(empty($name)) {
          return response()->json(['error' => 'Name required'], 401);
        }


        $idninja = Ninja::insertGetId(['nom' => $name]);
        $user->idninja = $idninja;
        $user->save();
        Competence::insert([
          ['idninja' => $idninja, 'niveau' => 1, 'idnomcompetence' => 0],
          ['idninja' => $idninja, 'niveau' => 100, 'idnomcompetence' => 1],
          ['idninja' => $idninja, 'niveau' => 100, 'idnomcompetence' => 2],
          ['idninja' => $idninja, 'niveau' => 100, 'idnomcompetence' => 3],
          ['idninja' => $idninja, 'niveau' => 2, 'idnomcompetence' => 4],
          ['idninja' => $idninja, 'niveau' => 2, 'idnomcompetence' => 5],
          ['idninja' => $idninja, 'niveau' => 2, 'idnomcompetence' => 6],
          ['idninja' => $idninja, 'niveau' => 2, 'idnomcompetence' => 7],
          ['idninja' => $idninja, 'niveau' => 2, 'idnomcompetence' => 8],
          ['idninja' => $idninja, 'niveau' => 0, 'idnomcompetence' => 9],
          ['idninja' => $idninja, 'niveau' => 100, 'idnomcompetence' => 10]
        ]);

        return redirect()->route('home');

      } else {

        return response()->json(['error' => 'A Ninja is Already Existing'], 401);

      }

    }
}
