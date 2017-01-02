<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titular extends Model
{
  protected $table = 'titulares';

  protected $fillable = [
      'nombre', 'apellido',
      'dni', 'domicilio', 'id_localidad',
      'telefono', 'email', 'contacto', 'id_usuario'
  ];

  public function localidad()
  {
    return $this->belongsTo('App\Localidad');
  }

  public function vehiculos()
  {
    return $this->hasMany('App\Vehiculo');
  }

  public function usuario()
  {
    return $this->belongsTo('App\User');
  }

}
