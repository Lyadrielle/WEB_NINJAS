<?php

namespace App\Http\Middleware;

use Closure;

use App\Exercice;

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
        $exo = Exercice::where('fin', '>', 'NOW()')->first();
        if(!empty($exo)) {
          return response()->json(['error' => 'Unauthorized'], 401);
        }



        return $next($request);
    }
}
