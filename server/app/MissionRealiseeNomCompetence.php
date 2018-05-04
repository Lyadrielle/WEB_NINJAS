<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MissionRealiseeNomCompetence extends Pivot
{

    protected $primaryKey = 'idrequerir';

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
    protected $hidden = [];

    public $timestamps = false;

}
