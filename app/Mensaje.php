<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'mensajes';

    protected $fillable = [
        'asunto', 'mensaje', 'leido'
    ];

    public function from()
    {
        return $this->hasOne('App\User', 'id', 'from_id');
    }

    public function to()
    {
        return $this->hasOne('App\User', 'id', 'to_id');
    }

    public function visto()
    {
        return $this->leido === null;
    }

    public function scopeOwner($query, User $user)
    {
        return $query->where('to_id', '=', $user->id);
    }

    public function scopeNoLeido($query)
    {
        return $query->whereNull('leido');
    }
}
