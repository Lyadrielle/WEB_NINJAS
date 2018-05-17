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

    public function max() {
      switch($this->idnomcompetence) {
        case 0:
          $r = 100;
          break;

        case 1:
          $r = 100;
          break;

        case 2:
          $r = 100;
          break;

        case 3:
          $r = 100;
          break;

        case 4:
          $r = 50;
          break;

        case 5:
          $r = 50;
          break;

        case 6:
          $r = 50;
          break;

        case 7:
          $r = 50;
          break;

        case 8:
          $r = 50;
          break;

        default:
          $r = null;
          break;
      }

    return $r;

  }

}
