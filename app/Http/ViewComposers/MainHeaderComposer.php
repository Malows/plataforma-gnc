<?php

namespace App\Http\ViewComposers;

use App\Mensaje;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MainHeaderComposer
{
    public function compose(View $view)
    {
        Carbon::setLocale('es');
        $mensajes = Mensaje::owner( Auth::user() )->noLeido()->orderBy('created_at', 'ASC')->limit(10)->get();
        $mensajes->each(function ($m){
            $m->from;
            $m->created_at = Carbon::createFromFormat( 'Y-m-d H:i:s', $m->created_at );
        });
        $view->with('tickets', Ticket::orderBy('created_at', 'ASC')->limit(10)->get() )
        ->with('mensajes', $mensajes );
    }
}