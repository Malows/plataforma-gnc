<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosCilindro extends Model
{
    protected $table = 'datos_cilindros';

    protected $fillable = [
        'codigo_homologado', 'marca_cilindro_id', 'matricula', 'modelo' ,'norma_fabricacion',
        'capacidad_nominal', 'diametro_nominal', 'longitud_nominal', 'espesor', 'dureza', 'material'
    ];

    public function marca()
    {
        return $this->hasOne('App\MarcaCilindro');
    }


}
