<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'tipo_usuario_id', 'habilitado',
        'fecha_de_licencia', 'duracion_de_licencia',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fecha_fin_licencia()
    {
        $date = Carbon::createFromFormat( 'Y-m-d H:i:s', $this->fecha_de_licencia );
        $date->addDays( $this->duracion_de_licencia );
        return $date;
    }

    public function dias_restantes_de_licencia()
    {
        $date = Carbon::createFromFormat( 'Y-m-d H:i:s', $this->fecha_de_licencia );
        $dif_date = Carbon::now()->diffInDays( $date );
        $days = $this->duracion_de_licencia - $dif_date;
        return $days;
    }

    public function tipo_usuario()
    {
      return $this->belongsTo('App\TipoUsuario');
    }

    public function marcas_de_autos_registradas()
    {
      return $this->hasMany('App\MarcaAutos');
    }

    public function modelos_de_autos_registrados()
    {
      return $this->hasMany('App\ModeloAutos');
    }

    public function titulares()
    {
      return $this->hasMany('App\Titular');
    }

    public function vehiculos()
    {
        return $this->hasMany('App\Vehiculo');
    }

    public function es_admin()
    {
        return $this->tipo_usuario_id === 1;
    }
}
