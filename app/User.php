<?php

namespace App;

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
        'tipo_usuario', 'habilitado',
        'fecha_de_licencia', 'duracion_de_licencia'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
}
