<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'description',
    ];

    protected $table = "mission";

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