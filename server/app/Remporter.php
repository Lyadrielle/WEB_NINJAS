<?php

namespace App;

use Illuminate\Database\Eloquent\Pivot;

class Remporter extends Pivot
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',  
    ];

    protected $table = "remporter";

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