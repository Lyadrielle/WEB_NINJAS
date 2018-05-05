<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercice;
use App\ExerciceNomCompetence;
use App\Utilisateur;
use DateTime;
use DateTimeZone;

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
          //max ?
          $competence->niveau = ($nomCompetence->pivot->valeur + $competence->niveau) < 0 ? 0 : ($nomCompetence->pivot->valeur + $competence->niveau);
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
        $dt->setTimezone(new DateTimeZone('Europe/Paris'));
        $dt->modify("+1 minute");
        $exo = Exercice::insertGetId(["fin" => $dt->format("Y-m-d H:i:s"), "statut" => 1, "action" => $action, "idninja" => $user->idninja]);
        foreach($array as $competence){
            ExerciceNomCompetence::insert(array_merge($competence, array("idexercice" => $exo)));
        }
    }

    //
}
