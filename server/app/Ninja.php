<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ninja extends Model
{

    protected $primaryKey = 'idninja';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'avatar',
    ];

    protected $table = "ninja";

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public $timestamps = false;

    public function objet() {
      return $this->hasOne('App/Objet', 'idobjet');
    }

    public function utilisateur() {
      return $this->hasOne('App\Utilisateur', $this->primaryKey);
    }

    public function exercices() {
      return $this->hasMany('App\Exercice', $this->primaryKey);
    }

    public function competences() {
      return $this->hasMany('App\Competence', $this->primaryKey);
    }
	
}
