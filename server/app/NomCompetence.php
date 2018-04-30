<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NomCompetence extends Model
{

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
    protected $hidden = [
        ,
    ];

    public $timestamps = false;

}