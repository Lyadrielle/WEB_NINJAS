<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NomCompetenceObjet extends Pivot
{

    protected $primaryKey = "idinfluencer";

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
    protected $hidden = [];

    public $timestamps = false;

}
