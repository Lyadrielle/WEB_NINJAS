<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercice;
use App\ExerciceNomCompetence;
use App\Utilisateur;
use DateTime;
use DateTimeZone;
use App\JSON;

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

    static public function update($user, $exercices) {
      $ninja = $user->ninja;
      $competences = $ninja->competences;

      foreach($exercices as $exercice) {
        $nomCompetences = $exercice->nomCompetences;
        foreach($nomCompetences as $nomCompetence) {
          $competence = $competences->where('idnomcompetence', '=', $nomCompetence->idnomcompetence)->first();
          //max ?
+          $competence->niveau = ($nomCompetence->pivot->valeur + $competence->niveau) < 0 ? 0 : ($nomCompetence->pivot->valeur + $competence->niveau);
          $competence->save();
        }
        $exercice->statut = 3;
        $exercice->save();
      }

    }

    static public function check($user) {
      $now = new DateTime();
      $now->setTimezone(new DateTimeZone('Europe/Paris'));
      $exercices = $user->ninja->exercices->where('fin', '<=', $now->format("Y-m-d H:i:s"));

      if(!empty($exercices)) {
        Self::update($user, $exercices);
      }

    }

    public function create(Request $request, $action){

        $competences = array();

        switch($action){
            case 0 : //manger
              $competences = array(["valeur" => 3, "idnomcompetence" => 0]);
            break;

            case 1 : //dormir
              $competences = array(["valeur" => 10, "idnomcompetence" => 1]);
            break;

            case 2 : //parler
              $competences = array(["valeur" => 10, "idnomcompetence" => 3]);
            break;

            case 3 : //lancer de shuriken (aug. force et agilité, baisse énergie et satiété)
              $competences = array(["valeur" => 1, "idnomcompetence" => 8] , ["valeur" => 2, "idnomcompetence" => 6] , ["valeur" => -2, "idnomcompetence" => 1] , ["valeur" => -1, "idnomcompetence" => 2]);
            break;

            case 4 : //lecture (aug. sagesse, baisse vie sociale)
              $competences = array(["valeur" => 2, "idnomcompetence" => 5] , ["valeur" => -1, "idnomcompetence" => 3]);
            break;

            case 5 : //dissimulation (aug. dissimulation, baisse vie sociale)
              $competences = array(["valeur" => 2, "idnomcompetence" => 4] , ["valeur" => -1, "idnomcompetence" => 3]);
            break;

            case 6 : //musculation (aug. force et endurance, baisse énergie et satiété)
              $competences = array(["valeur" => 2, "idnomcompetence" => 8] , ["valeur" => 1, "idnomcompetence" => 7] , ["valeur" => -2, "idnomcompetence" => 1] , ["valeur" => -2, "idnomcompetence" => 2]);
            break;

            case 7 : //jonglage (aug. agilité et endurance, baisse énergie et satiété)
              $competences = array(["valeur" => 2, "idnomcompetence" => 6] , ["valeur" => 2, "idnomcompetence" => 7] , ["valeur" => -1, "idnomcompetence" => 1] , ["valeur" => -1, "idnomcompetence" => 2]);
            break;

            default:
              return response()->json(JSON::error('Not Found'), 404);
			break;

        }

        $this->evolving($competences, $request->session()->get("utilisateur"), $action);
        return redirect()->route('home');

    }

    public function evolving($array, $id, $action) {
        $user = Utilisateur::where('idutilisateur', $id)->first();
        $dt = new DateTime();
		$dt->setTimezone(new DateTimeZone('Europe/Paris'));
        $dt->modify("+1 minute");
        $exo = Exercice::insertGetId(["fin" => $dt->format("Y-m-d H:i:s"), "statut" => 1, "action" => $action, "idninja" => $user->idninja]);
        foreach($array as $competence){
            ExerciceNomCompetence::insert(array_merge($competence, array("idexercice" => $exo)));
        }
    }

    //
}
