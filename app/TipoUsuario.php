<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
  protected $table = 'tipos_usuarios';

  protected $fillable = [
      'nombre'
  ];

  public function usuarios()
  {
    return $this->hasMany('App\User');
  }
}
