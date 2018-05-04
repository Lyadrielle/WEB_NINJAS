<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{

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
    protected $hidden = [
        ,
    ];

    public $timestamps = false;

    public function name() {
      return $this->hasOne('App\NomCompetence', 'idcompetence');
    }

}
