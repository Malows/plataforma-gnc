<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcaAutos extends Model
{
    protected $table = 'marcas_autos';

    protected $fillable = [
      'nombre', 'id_usuario'
    ];

    public function modelos()
    {
    return $this->hasMany('App\ModeloAutos');
    }

    public function vehiculos()
    {
    return $this->hasMany('App\Vehiculo');
    }

    public function usuario()
    {
    return $this->belongsTo('App\User');
    }

    public function scopeOwnerOrAdmin($query, $user)
    {
      if ( $user->es_admin() )
          return $query;
      return $query->where('user_id', '=', $user->id);
    }
}
