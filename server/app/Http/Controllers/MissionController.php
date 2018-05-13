<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilisateur;
use App\Mission;
use App\MissionRealisee;
use App\MissionRealiseeNomCompetence;
use App\Competence;
use DateTime;
use DateTimeZone;

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

    public function create(Request $request, $action){

        $competences = array();

        switch($action){
            case 0 :
              $competences = array(["minimum" => 3, "idnomcompetence" => 0]);
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
        $mission = MissionRealisee::insertGetId(["fin" => $dt->format("Y-m-d H:i:s"), "statut" => 1, "idutilisateur" => $user]);
        foreach($array as $competence){
            MissionRealiseeNomCompetence::insert(array_merge($competence, array("idmrealisee" => $mission)));
        }
    }
	
	public function update(Request $request) {
      $user = Utilisateur::where('idutilisateur', $request->session()->get("utilisateur"))->first();
      $ninja = $user->ninja;
      $competences = $ninja->competences;
      $exercices = $ninja->missions->where("statut", '=', 2);

      foreach($missions as $mission) {
        $nomCompetences = $mission->nomCompetences;
        foreach($nomCompetences as $nomCompetence) {
          $competence = $competences->where('idnomcompetence', '=', $nomCompetence->idnomcompetence)->first();
          //max ?
+          $competence->niveau = ($nomCompetence->pivot->valeur + $competence->niveau) < 0 ? 0 : ($nomCompetence->pivot->valeur + $competence->niveau);
          $competence->save();
        }
        $mission->statut = 3;
        $mission->save();
      }

      return redirect()->route('home');
    }

}