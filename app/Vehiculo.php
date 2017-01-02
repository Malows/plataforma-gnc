<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
  protected $table = 'vehiculos';

  protected $fillable = [
      'dominio', 'id_titular', 'id_marca', 'id_modelo', 'id_usuario', 'año'
  ];

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
}
