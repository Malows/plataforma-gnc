<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    use softDeletes;

    protected $table = 'vehiculos';

    protected $fillable = [ 'dominio', 'id_titular', 'id_marca', 'id_modelo', 'id_usuario', 'año' ];

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
}
