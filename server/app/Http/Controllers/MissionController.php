<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilisateur;
use App\Mission;
use App\MissionRealisee;
use App\MissionRealiseeNomCompetence;
use App\Competence;
use App\JSON;
use DateTime;
use DateTimeZone;
use App\Http\Controllers\CompetenceController;

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

    static public function generate($idutilisateur, $difficulty) {

        $user = Utilisateur::where('idutilisateur', $idutilisateur)->first();

        $missions = Mission::get();

        $idMission = rand(1, count($missions));

        $mission = $missions->where('idmission', $idMission)->first();

        $idmrealisee = MissionRealisee::insertGetId(['idutilisateur' => $idutilisateur, 'difficulte' => $difficulty, 'statut' => 0, 'idmission' => $idMission]);

        $arrayComp = CompetenceController::generateRequirementsForMission(rand(1, 5), rand(6, 10), rand(2, 5));

        foreach($arrayComp as $comp) {
          MissionRealiseeNomCompetence::insert(['idmrealisee' => $idmrealisee, 'minimum' => $comp['valeur'] * $difficulty, 'idnomcompetence' => $comp['idnomcompetence']]);
        }

    }

    static public function check($user) {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Europe/Paris'));
        $missions = $user->missionRealisee->where(['fin', '<=', $now->format("Y-m-d H:i:s")], ['fin', '<>', '']);
        foreach($missions as $mission) {
          Self::complete($mission->idmrealisee, $user);
        }
    }


    static public function complete($idmrealisee, $user) {
        $mission = $user->missionRealisee->where('idmrealisee', $idmrealisee)->first();

        $ninja = $user->ninja;

        $mission->statut = 3;
        if(rand(0, 99) < $mission->pourcentage)
        CompetenceController::levelup((100 + $ninja->competence(0)->niveau) * $mission->difficulte, $ninja->competences);
        $mission->save();

        Self::generate($user->idutilisateur, $mission->difficulte);

    }

    public function start(Request $request) {

      $this->validate($request, [
        'id' => 'required'
      ]);

      $id = $request->input('id');

      $user = Utilisateur::where('idutilisateur', $request->session()->get('utilisateur'))->first();

      $mission = $user->missionRealisee->where('idmrealisee', $id)->first();

      if(empty($mission)) return response()->json(JSON::errorMission('Mission Not Found', null, $id), 404);
      if($mission->statut != 0) return response()->json(JSON::errorMission('Mission Already Started', $mission->fin, $mission->idmrealisee), 401);

      $competencesRequired = $mission->competences;
      $competencesNinja = $user->ninja->competences;

      $pourcentage = Self::success($competencesRequired, $competencesNinja);

      if($pourcentage < 0) return response()->json(JSON::errorMission('Not Enough Energy', null, $mission->idmrealisee), 401);

      $mission->statut = 1;

      $dt = new DateTime();
      $dt->setTimezone(new DateTimeZone('Europe/Paris'));
      $temps = 1 * $mission->difficulte;
      $dt->modify("+$temps minute");

      $mission->fin = $dt;

      $mission->pourcentage = $pourcentage;

      $mission->save();

      return response()->json(JSON::success($dt->format("Y-m-d H:i:s")));


    }

    static public function success($competencesRequired, $competencesNinja) {
        $energyRequired = $competencesRequired->where('idnomcompetence', 1)->first();
        $energyNinja = $energyRequired->findEquivalent($competencesNinja);
        if($energyNinja->niveau - $energyRequired->minimum < 0) {
          return -1;
        }

        return Self::calculate($competencesRequired, $competencesNinja);

    }

    static public function calculate($competencesRequired, $competencesNinja) {
      $pourcentage = 100;

      foreach($competencesRequired as $competenceRequired) {
        $competenceNinja = $competenceRequired->findEquivalent($competencesNinja);
        $pourcentage += ceil(($competenceNinja->niveau - $competenceRequired->minimum - 1) / ($competenceRequired->minimum + 1) * 100 - 100);
      }

      if($pourcentage < 0) $pourcentage = 0;
      if($pourcentage > 100) $pourcentage = 100;

      return $pourcentage;

    }

}
