<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use App\Utilisateur;

use App\Http\Controllers\MissionController;

class UtilisateurController extends Controller
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

    public function signin(Request $request)

   {

       $this->validate($request, [

       'pseudo' => 'required',
       'motdepasse' => 'required'

        ]);

      $user = Utilisateur::where('pseudo', $request->input('pseudo'))->first();

     if(!empty($user) && Hash::check($request->input('motdepasse'), $user->motdepasse)){

          $request->session()->put('utilisateur', $user->idutilisateur);
          return redirect()->route('home');

      } else {

          return response()->json(['status' => 'fail'], 401);

      }

   }


   public function signup(Request $request) {

     $this->validate($request, [

       'pseudo' => 'required',
       'motdepasse' => 'required',
       'nom' => 'required'

     ]);

     $existing = Utilisateur::where('pseudo', $request->input('pseudo'))->first();

     if(empty($existing)) {
       $id = Utilisateur::insertGetId(['pseudo' => $request->input('pseudo'), 'motdepasse' => Hash::make($request->input('motdepasse'))]);
       $request->session()->put('utilisateur', $id);
       $name = $request->input('nom');

       MissionController::generate($id, 1);
       MissionController::generate($id, 2);
       MissionController::generate($id, 3);

       return redirect()->route('ninja', ['name' => $name]);

     } else {

       return response()->json(['error' => 'Pseudo Already Existing'], 401);

     }

   }

}
