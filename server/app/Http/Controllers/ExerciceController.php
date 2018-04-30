<?php

namespace App\Http\Controllers;

use App\Exercice;
use App\ExerciceCompetence;
use App\Utilisateur;

class ExerciceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(Request $request, $action){

        $competences = array();

        switch($action){
            case 0 :
              $competences = array(["valeur" => 3, "idnomcompetence" => 0]);
            break;

            default:
              return response()->json(['error' => 'Not Found'], 404);
            break;
        }

        $this->evolving($competences, $request->session()->get("utilisateur"), $action);
        return redirect()->route('home');

    }

    public function evolving($array, $id, $action) {
        $user = Utilisateur::where('idutilisateur', $id)->first();
        $dt = new DateTime();
        $dt->modify("+1 minute");
        $exo = Exercice::insertGetId(["fin" => $dt->format("Y-m-d H:i:s"), "action" => $action, "idninja" => $user->ninja()->idninja]);
        foreach($array as $competence){
            ExerciceCompetence::insert(array_merge($competence, array("idExercice" => $exo)));
        }
    }

    //
}
