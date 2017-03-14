<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrabajoDeTaller extends Model
{

    protected $table = 'trabajos_de_talleres';

    protected $dates = [ 'fecha_de_turno', 'por_revisar_at', 'en_proceso_at', 'finalizado_at', 'created_at', 'updated_at' ];

    protected $fillable = [ 'user_id', 'servicio_de_taller_id', 'vehiculo_id', 'estado', 'fecha_de_turno',
        'por_revisar_at', 'en_proceso_at', 'finalizado_at' ];

    protected $hidden = [ ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function servicio(){
        return $this->hasOne('App\ServicioDeTaller');
    }

    public function vehiculo() {
        return $this->belongsTo('App\Vehiculo');
    }

    public function scopeOwnerOrAdmin($query, $user)
    {
        if ( $user->es_admin() )
            return $query;
        return $query->where('user_id', '=', $user->id);
    }
}
