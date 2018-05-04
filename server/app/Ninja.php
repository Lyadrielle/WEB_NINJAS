<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ninja extends Model
{

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

    public function exercices() {
      return $this->hasMany('App\Exercice', 'idninja');
    }
}
