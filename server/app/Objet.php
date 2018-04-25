<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'description',
    ];

    protected $table = 'objet';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        ,
    ];

    public $timestamps = false;

    public function utilisateurs() {
      return $this->belongsToMany('App\Utilisateur', 'posseder', 'idobjet', 'idutilisateur');
    }

}
