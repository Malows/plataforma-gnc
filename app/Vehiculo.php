<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    use softDeletes;

    protected $table = 'vehiculos';

    protected $fillable = [ 'dominio', 'titular_id', 'marca_id', 'modelo_id', 'user_id', 'año' ];

    protected $dates = ['deleted_at'];

    public function usuario()
    {
    return $this->belongsTo('App\User');
    }

    public function titular()
    {
    return $this->belongsTo('App\Titular');
    }

    public function marca()
    {
        return $this->belongsTo('App\MarcaAutos');
    }

    public function modelo()
    {
        return $this->belongsTo('App\ModeloAutos');
    }

    public function trabajos_de_taller()
    {
        return $this->hasMany('App\TrabajoDeTaller');
    }

    public function scopeOwnerOrAdmin($query, User $user)
    {
        if ( $user->es_admin() ) {
            return $query->withTrashed();
        }
        return $query->where('user_id', $user->id);
    }
}
