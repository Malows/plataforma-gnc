<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcaCilindro extends Model
{
    protected $table = 'marcas_cilindros';

    protected $fillable = [
        'nombre', 'user_id'
    ];

    public function cilindros()
    {
        return $this->hasMany('App\Cilindro');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeOwnerOrAdmin($query, User $user)
    {
        if ( $user->es_admin() )
            return $query;
        return $query->where('user_id', '=', $user->id);
    }
}
