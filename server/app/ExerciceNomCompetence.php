<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ExerciceNomCompetence extends Pivot
{

    protected $primaryKey = 'identrainer';

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
    protected $hidden = [];

    public $timestamps = false;

}
