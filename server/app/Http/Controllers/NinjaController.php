<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ninja;

use App\Utilisateur;

class NinjaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    //

    public function create(Request $request) {

      $this->validate([

        'nom' => 'required',
        'avatar' => 'required',

      ]);

      $user = Utilisateur::where('idutilisateur', $request->session()->get('utilisateur'))->first();

      if(empty($user->idninja)) {
        $idninja = Ninja::insertGetId(['nom' => $request->input('nom'), 'avatar' => $request->input('avatar')]);
        $user->idninja = $idninja;
        $user->save();
        return redirect()->route('home');

      } else {

        return response()->json(['error' => 'A Ninja is Already Existing']);

      }

    }
}
