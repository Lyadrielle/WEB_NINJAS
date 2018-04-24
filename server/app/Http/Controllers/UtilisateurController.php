<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use App\Utilisateur;

class UtilisateurController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api')
    }


    static public function idFromPseudo($pseudo) {
      $user = Utilisateur::where('pseudo', $pseudo)->first();
      if(!empty($user)) {
        return $user->idutilisateur;
      } else {
        return null;
      }
    }

    public function signin(Request $request)

   {

       $this->validate($request, [

       'pseudo' => 'required',
       'motdepasse' => 'required'

        ]);

      $user = Utilisateur::where('pseudo', $request->input('pseudo'))->first();

     if(!empty($user) && Hash::check($request->input('motdepasse'), $user->motdepasse)){

          $request->session()->put('utilisateur', Self::idFromPseudo($request->input('pseudo')));
          return reditect()->route('home');

      } else {

          return response()->json(['status' => 'fail'], 401);

      }

   }


   public function signup(Request $request) {

     $this->validate($request, [

       'pseudo' => 'required',
       'motdepasse' => 'required'

     ]);

     $existing = Utilisateur::where('pseudo', $request->input('pseudo'))->first();

     if(empty($existing)) {
       Utilisateur::insert(['pseudo' => $request->input('pseudo'), 'motdepasse' => Hash::make($request->input('motdepasse'))]);
       $request->session()->put('utilisateur', Self::idFromPseudo($request->input('pseudo')));
       return redirect()->route('home');

     } else {

       return response()->json(['error' => 'Pseudo Already Existing']);

     }

   }

}
