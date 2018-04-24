<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Utilisateur extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudo',
    ];

    protected $table = 'utilisateur';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'motdepasse',
    ];

    public $timestamps = false;

    public function ninja() {
      return $this->hasOne('App/Ninja', 'idutilisateur');
    }

    public function objets() {
      return $this->belongsToMany('App/Objet', 'posseder', 'idutilisateur', 'idobjet');
    }

}
