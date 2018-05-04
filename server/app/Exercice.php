<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{

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
    protected $hidden = [
        ,
    ];

    public $timestamps = false;

    public function objet() {
      return $this->hasOne('App/Objet', 'idninja');
    }

    public function utilisateur() {
      return $this->belongsTo('App\Utilisateur', 'idninja');
    }
}
