<?php

namespace App;

use Illuminate\Database\Eloquent\Pivot;

class ExerciceCompetence extends Pivot
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'valeur',  
    ];

    protected $table = "entrainer";

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