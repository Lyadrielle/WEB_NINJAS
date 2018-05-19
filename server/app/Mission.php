<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{

    protected $primaryKey = 'idmission';

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
    protected $hidden = [];

    public $timestamps = false;

    public function objets() {
      return $this->belongsToMany('App\Objet', 'remporter', $this->primaryKey, 'idobjet')->withPivot('loot');
    }

}
