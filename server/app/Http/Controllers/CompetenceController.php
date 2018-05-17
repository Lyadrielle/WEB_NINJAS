<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competence;
use App\Utilisateur;

class CompetenceController extends Controller
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

    public function addExp(Request $request) {

		$this->validate([
			'reward' => 'required',
		]);


		$user = Utilisateur::where('idutilisateur', $request->session()->get("utilisateur"))->first();
		$competences = $user->ninja->competences;
    Self::levelup($request->input('reward'), $competences);

		return route()->redirect('home');


	}

	static public function levelup($reward, $competences) {

		$exp = $competences->where('idnomcompetence', 9)->first();
		$expMax = $competences->where('idnomcompetence', 10)->first();
		$level = $competences->where('idnomcompetence', 0)->first();

		$need = $expMax->niveau - $exp->niveau;

		if($reward - $need >= 0) {
			$reward -= $need;
			$exp->niveau = 0;
			$exp->save();
			$expMax->niveau *= 1.2;
            $expMax->save();
            $level->niveau++;
            $level->save();

            Self::skillsUp(rand(2,3), $competences);

			Self::levelup($reward, $competences);

		} else {

			$exp->niveau += $reward;
			$exp->save();

		}

	}


  static public function generateRequirementsForMission($min, $max, $n) {

    $competences = array(['valeur' => 10, 'idnomcompetence' => 1]);

    $ids = array(2, 3, 4, 5, 6, 7, 8);

    for($i = 0; $i < $n && count($ids) > 0; ++$i) {
      $random = rand(0, count($ids) - 1);
      $value = ($ids[$random] != 2 && $ids[$random] != 3) ? rand($min, $max) : 10;
      array_push($competences, ['valeur' => $value, 'idnomcompetence' => $ids[$random]]);
      array_splice($ids, $random, 1);
    }


    return $competences;
  }


	static public function skillsUp($points, $competences){

		while ($points != 0){
			$comp = $competences->where('idnomcompetence', rand(4,8))->first();
      $comp->niveau += 1;
			$points -= 1;
      $comp->save();
		}

	}

}
