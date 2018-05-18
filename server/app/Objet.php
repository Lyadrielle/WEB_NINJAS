<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{

    protected $primaryKey = "idobjet";

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
    protected $hidden = [];

    public $timestamps = false;

    public function utilisateurs() {
      return $this->belongsToMany('App\Utilisateur', 'posseder', $this->primaryKey, 'idutilisateur');
    }

    public function competences() {
      return $this->belongsToMany('App\NomCompetence', 'influencer', $this->primaryKey, 'idnomcompetence')->withPivot('bonus');
    }

}
