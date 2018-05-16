<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{

    protected $primaryKey = 'idexercice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fin', 'action', 'statut'
    ];

    protected $table = "exercice";

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public $timestamps = false;

    public function nomCompetences() {
      return $this->belongsToMany('App\NomCompetence', 'entrainer', $this->primaryKey, 'idnomcompetence')->withPivot('valeur');;
    }

    public function ninja() {
      return $this->belongsTo('App\Ninja', 'idninja');
    }

}
