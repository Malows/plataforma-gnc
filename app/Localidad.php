<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';

    protected $fillable = [
        'nombre', 'codigo_postal'
    ];

    public function provincia()
    {
      return $this->belongsTo('App\Provincia');
    }

    public function titulares()
    {
      return $this->hasMany('App\Titular');
    }

    public function scopeSearch($query, $provincia)
    {
        return $query->where('provincia_id', '=', $provincia);
    }

}
