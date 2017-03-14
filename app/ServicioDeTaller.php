<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioDeTaller extends Model
{

    protected $table = 'servicios_de_talleres';

    protected $fillable = [ 'nombre', 'user_id' ];

    protected $hidden = [ ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function trabajos()
    {
        return $this->hasMany('App\TrabajoDeTaller');
    }

    public function scopeOwnerOrAdmin($query, $user)
    {
        if ( $user->es_admin() )
            return $query;
        return $query->where('user_id', '=', $user->id);
    }
}
