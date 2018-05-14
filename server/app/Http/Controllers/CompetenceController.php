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
    $exp = $competences->where('idnomcompetence', 9);
		$expMax = $competences->where('idnomcompetence', 10);
		$level = $competences->where('idnomcompetence', 0);

		return Self::levelup($request->input('reward'), $exp, $expMax, $level);


	}

	static public function levelup($reward, $exp, $expMax, $level) {

		$need = $expMax->niveau - $exp->niveau;

		if($reward - $need >= 0) {
			$reward -= $need;
			$exp->niveau = 0;
			$exp->save();
			$expMax->niveau *= 1.2;
            $expMax->save();
            $level->niveau++;
            $level->save();

			return $this->levelup($request, $reward);

		} else {

			$exp->niveau += $reward;
			$exp->save();

		}

		return route()->redirect('home');

	}

}
