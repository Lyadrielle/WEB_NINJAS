<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercice;
use App\ExerciceNomCompetence;
use App\Utilisateur;
use DateTime;

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

    public function update(Request $request) {
      $user = Utilisateur::where('idutilisateur', $request->session()->get("utilisateur"))->first();
      $ninja = $user->ninja;
      $competences = $ninja->competences;
      $exercices = $ninja->exercices->where("statut", '=', 2);

      foreach($exercices as $exercice) {
        $nomCompetences = $exercice->nomCompetences;
        foreach($nomCompetences as $nomCompetence) {
          $competence = $competences->where('idnomcompetence', '=', $nomCompetence->idnomcompetence)->first();
          $competence->niveau += $nomCompetence->pivot->valeur;
          $competence->save();
        }
        $exercice->statut = 3;
        $exercice->save();
      }

      return redirect()->route('home');
    }

    public function create(Request $request, $action){

        $competences = array();

        switch($action){
            case 0 : //manger
              $competences = array(["valeur" => 10, "idnomcompetence" => 2]);
            break;

            case 1 : //dormir
              $competences = array(["valeur" => 10, "idnomcompetence" => 1]);
            break;

            case 2 : //parler
              $competences = array(["valeur" => 10, "idnomcompetence" => 3]);
            break;

            case 3 : //lancer de shuriken (aug. force et agilité, baisse énergie et satiété)
              $competences = array(["valeur" => 2, "idnomcompetence" => 8] , ["valeur" => 3, "idnomcompetence" => 6] , ["valeur" => -3, "idnomcompetence" => 1] , ["valeur" => -2, "idnomcompetence" => 2]);
            break;

            case 4 : //lecture (aug. sagesse, baisse vie sociale)
              $competences = array(["valeur" => 3, "idnomcompetence" => 5] , ["valeur" => -2, "idnomcompetence" => 3]);
            break;

            case 5 : //dissimulation (aug. dissimulation, baisse vie sociale)
              $competences = array(["valeur" => 3, "idnomcompetence" => 4] , ["valeur" => -2, "idnomcompetence" => 3]);
            break;

            case 6 : //musculation (aug. force et endurance, baisse énergie et satiété)
              $competences = array(["valeur" => 3, "idnomcompetence" => 8] , ["valeur" => 2, "idnomcompetence" => 7] , ["valeur" => -3, "idnomcompetence" => 1] , ["valeur" => -3, "idnomcompetence" => 2]);
            break;

            case 7 : //jonglage (aug. agilité et endurance, baisse énergie et satiété)
              $competences = array(["valeur" => 3, "idnomcompetence" => 6] , ["valeur" => 3, "idnomcompetence" => 7] , ["valeur" => -2, "idnomcompetence" => 1] , ["valeur" => -2, "idnomcompetence" => 2]);
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
        $exo = Exercice::insertGetId(["fin" => $dt->format("Y-m-d H:i:s"), "statut" => 1, "action" => $action, "idninja" => $user->idninja]);
        foreach($array as $competence){
            ExerciceNomCompetence::insert(array_merge($competence, array("idexercice" => $exo)));
        }
    }

    //
}
