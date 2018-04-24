<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ninja;

use App\Utilisateur;

class ExampleController extends Controller
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

      if(empty($user->ninja)) {
        $id = Ninja::insertGetId(['nom' => $request->input('nom'), 'avatar' => $request->input('avatar')]);
        $user->idninja = $id;
        $user->save();
        return redirect()->route('home');

      } else {

        return response()->json(['error' => 'A Ninja Already Existing']);

      }

    }
}
