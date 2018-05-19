<?php

namespace App\Http\Controllers;

use App\Utilisateur;
use App\JSON;
use Illuminate\Http\Request;

class ObjetController extends Controller
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

    public function equip(Request $request) {
      $this->validate($request, [
        'slot' => 'required'
      ]);

      $slot = $request->input('slot');


      $user = Utilisateur::where('idutilisateur', $request->session()->get('utilisateur'))->first();
      $objet = $user->objets->where('idobjet', $slot)->first();
      if(empty($objet)) {
        return response()->json(JSON::error('Object Not Found', $slot), 404);
      }

      $ninja = $user->ninja;
      $ninja->idobjet = $slot;
      $ninja->save();

      return response()->json(JSON::success(null));

    }

    public function unequip(Request $request) {
      $user = Utilisateur::where('idutilisateur', $request->session()->get('utilisateur'))->first();
      $ninja = $user->ninja;

      $ninja->idobjet = null;
      $ninja->save();

      return response()->json(JSON::success(null));
    }


}
