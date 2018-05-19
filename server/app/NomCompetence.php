<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NomCompetence extends Model
{

    protected $primaryKey = "idnomcompetence";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
    ];

    protected $table = "nomcompetence";

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public $timestamps = false;

    public function competenceByNinjaID($idninja) {
      return $this->hasMany('App\Competence', $this->primaryKey)->where('idninja', $idninja)->first();
    }

    public function findEquivalent($competences) {
      return $competences->where('idnomcompetence', $this->idnomcompetence)->first();
    }

}
