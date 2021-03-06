<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloAutos extends Model
{
    protected $table = 'modelos_autos';

    protected $fillable = [
      'nombre', 'marca_autos_id', 'user_id'
    ];

    public function marca()
    {
        return $this->belongsTo('App\MarcaAutos');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User');
    }

    public function vehiculos()
    {
        return $this->hasMany('App\Vehiculo');
    }

    public function scopeOwnerOrAdmin($query, User $user)
    {
        if ( $user->es_admin() )
            return $query;
        return $query->where('user_id', '=', $user->id);
    }
}
