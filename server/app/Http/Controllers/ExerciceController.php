<?php

namespace App\Http\Controllers;

use App\Exercice;
use App\ExerciceCompetence;

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
        switch($action){
            case 0 :
            $this->evolving([["valeur" => 3, "idnomcompetence" => 0]], $request->session()->get("utilisateur"), $action);
            break;

            default:
            break;
        }
    }

    public function evolving($array, $id, $action){
        $dt = new DateTime();
        $dt->modify("+1 minutes"); 
        $exo = Exercice::insertGetId(["fin" => $dt->format("Y-m-d H:i:s"), "action" => $action]); 
        foreach($array as $competence){
            ExerciceCompetence::insert(array_merge($competence, array("idExercice" => $exo)));
        }
    }

    //
}
