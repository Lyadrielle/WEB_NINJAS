<?php

namespace App;

use Illuminate\Database\Eloquent\Pivot;

class NomCompetenceObjet extends Pivot
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bonus',  
    ];

    protected $table = "influencer";

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