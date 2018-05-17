<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{

    protected $primaryKey = 'idcompetence';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'niveau',
    ];

    protected $table = "competence";

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public $timestamps = false;

    public function nomCompetence() {
      return $this->belongsTo('App\NomCompetence', 'idnomcompetence');
    }

    public function findEquivalent($competences) {
      return $competences->where('idnomcompetence', $this->idnomcompetence)->first();

    }

}
