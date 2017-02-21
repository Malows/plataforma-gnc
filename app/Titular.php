<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Titular extends Model
{
    use softDeletes;

    protected $table = 'titulares';

    protected $fillable = [ 'nombre', 'apellido', 'dni', 'domicilio', 'id_localidad', 'telefono',
        'email', 'contacto', 'id_usuario' ];

    protected $dates = ['deleted_at'];

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
