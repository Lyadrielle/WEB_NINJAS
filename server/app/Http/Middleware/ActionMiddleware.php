<?php

namespace App\Http\Middleware;

use Closure;

use App\Exercice;
use App\MissionRealisee;
use App\Utilisateur;

class ActionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		//ça fait beuguer avec
		/*$user = Utilisateur::where('idutilisateur', $request->session()->get("utilisateur"))->first();
+        $exo = $user->ninja->exercices->where('statut', '<', 3)->first();*/
		$exo = Exercice::where('fin', '>', 'NOW()')->first();
		$mission = MissionRealisee::where('fin', '>', 'NOW()')->first();
        
        if(!empty($exo) || !empty($mission)) {
          return response()->json(['error' => 'Unauthorized'], 401);
        }
		
        return $next($request);
    }
}
