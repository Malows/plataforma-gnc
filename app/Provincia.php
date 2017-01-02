<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincias';

    protected $fillable = [
      'nombre'
    ];

    protected $hidden = [

    ];

    public function localidades()
    {
      return $this->hasMany('App\Localidad');
    }
}
