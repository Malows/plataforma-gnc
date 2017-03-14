<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cilindro extends Model
{
    protected $table = 'cilindros';

    protected $fillable = [
        'codigo_de_cilindro', 'datos_cilindro_id', 'marca_cilindro_id', 'tipo_cilindro', 'volumen',
        'vehiculo_id', 'fecha_de_fabricacion', 'ultima_prueba_hidraulica', 'resultado_de_prueba_hidraulica',
        'fecha_de_vencimiento', 'user_id'
    ];

    protected $dates = [
        'fecha_de_fabricacion', 'ultima_prueba_hidraulica', 'fecha_de_vencimiento', 'created_at', 'updated_at'
    ];


    public function marca()
    {
        return $this->hasOne('App\MarcaAutos');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User');
    }

    public function vehiculos()
    {
        return $this->hasOne('App\Vehiculo');
    }

    public function scopeOwnerOrAdmin($query, User $user)
    {
        if ( $user->es_admin() )
            return $query;
        return $query->where('user_id', '=', $user->id);
    }
}
