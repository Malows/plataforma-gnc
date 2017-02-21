<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use softDeletes;

    protected $table = 'tickets';

    protected $dates = ['deleted_at'];

    protected $fillable = [ 'mensaje' ];

    protected $hidden = [ ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeOwnerOrAdmin($query, $user)
    {
        if ( $user->es_admin() )
            return $query;
        return $query->where('user_id', '=', $user->id);
    }
}
