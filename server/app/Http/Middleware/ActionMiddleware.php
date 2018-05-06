<?php

namespace App\Http\Middleware;

use Closure;

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
        $user = Utilisateur::where('idutilisateur', $request->session()->get("utilisateur"))->first();
        $exo = $user->ninja->exercices->where('statut', '<', 3)->first();
        if(!empty($exo)) {
          return response()->json(['error' => 'Unauthorized'], 401);
        }



        return $next($request);
    }
}
