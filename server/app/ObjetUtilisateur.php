<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ObjetUtilisateur extends Pivot
{

    protected $primaryKey = "idremporter";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $table = "posseder";

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public $timestamps = false;

}
