<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilisateur;
use App\Mission;
use App\MissionRealisee;
use App\MissionRealiseeNomCompetence;
use App\Competence;
use DateTime;

class MissionController extends Controller
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
      $missions = $user->missions->where("statut", '=', 2);

      foreach($missions as $mission) {
        $nomCompetences = $mission->nomCompetences;
        foreach($nomCompetences as $nomCompetence) {
          $competence = $competences->where('idnomcompetence', '=', $nomCompetence->idnomcompetence)->first();
          $competence->niveau += $nomCompetence->pivot->valeur;
          $competence->save();
        }
        $mission->statut = 3;
        $mission->save();
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
        $dt->modify("+1 minute");
        $mission = MissionRealisee::insertGetId(["fin" => $dt->format("Y-m-d H:i:s"), "statut" => 1, "action" => $action, "idutilisateur" => $user]);
        foreach($array as $competence){
            MissionRealiseeNomCompetence::insert(array_merge($competence, array("idmrealisee" => $mission)));
        }
    }

    //
}
