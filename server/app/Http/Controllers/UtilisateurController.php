<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use App\Utilisateur;

use App\Http\Controllers\MissionController;

use App\JSON;

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

          return response()->json(JSON::error('Incorrect ids'), 401);

      }

   }


   public function signup(Request $request) {

     $this->validate($request, [

       'pseudo' => 'required',
       'motdepasse' => 'required',
       'nom' => 'required'

     ]);

     $pseudo = $request->input('pseudo');

     $existing = Utilisateur::where('pseudo', $pseudo)->first();

     if(empty($existing)) {
       $id = Utilisateur::insertGetId(['pseudo' => $pseudo, 'motdepasse' => Hash::make($request->input('motdepasse'))]);
       $request->session()->put('utilisateur', $id);
       $name = $request->input('nom');

       MissionController::generate($id, 1);
       MissionController::generate($id, 2);
       MissionController::generate($id, 3);

       return redirect()->route('ninja', ['name' => $name]);

     } else {

       return response()->json(JSON::error('Pseudo Already Existing'), 401);

     }

   }

}
