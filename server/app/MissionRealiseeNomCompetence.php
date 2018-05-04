<?php

namespace App;

use Illuminate\Database\Eloquent\Pivot;

class MissionRealiseeNomCompetence extends Pivot
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'minimum',  
    ];

    protected $table = "requerir";

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