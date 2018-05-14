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
		
		return Self::levelup($request->input('reward'), $exp, $competences);
		
		
	}
	
	static public function levelup($reward, $competences) {
		
		$exp = $competences->where('idnomcompetence', 9);
		$expMax = $competences->where('idnomcompetence', 10);
		$level = $competences->where('idnomcompetence', 0);

		$need = $expMax->niveau - $exp->niveau;
		
		if($reward - $need >= 0) {
			$reward -= $need;
			$exp->niveau = 0;
			$exp->save();
			$expMax->niveau *= 1.2;
            $expMax->save();
            $level->niveau++;
            $level->save();

            skillsUp(rand(2,3), $competences);
			
			return $this->levelup($request, $reward);
			
		} else {
			
			$exp->niveau += $reward;
			$exp->save();
			
		}
		
		return route()->redirect('home');
		
	}

	public function skillsUp($points, $competences){

		while ($points != 0){
			$competences->where('idnomcompetence', rand(4,8))->niveau += 1;
			$points -= 1;
		}
		$competences->save();
		
	}
			
}
