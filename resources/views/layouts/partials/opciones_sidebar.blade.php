<li>
    <a href="{{ route('dashboard') }}"><i class='fa fa-home'></i> <span>{{ trans('message.home') }}</span></a>
</li>
@includeWhen( Auth::user()->tipo_usuario_id <= 6, 'layouts.partials.opciones.bronce')
@includeWhen( Auth::user()->tipo_usuario_id <= 5, 'layouts.partials.opciones.plata')
@includeWhen( Auth::user()->tipo_usuario_id <= 4, 'layouts.partials.opciones.oro')
@includeWhen( Auth::user()->tipo_usuario_id <= 3, 'layouts.partials.opciones.platino')
@includeWhen( Auth::user()->tipo_usuario_id <= 2, 'layouts.partials.opciones.diamante')

<li class="treeview">
    <a href="#"><i class='fa fa-link'></i> <span>Recursos</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        @includeWhen(Auth::user()->tipo_usuario_id <= 6, 'layouts.partials.opciones.bronce_recursos')
        @includeWhen(Auth::user()->tipo_usuario_id <= 5, 'layouts.partials.opciones.plata_recursos')
        @includeWhen(Auth::user()->tipo_usuario_id <= 4, 'layouts.partials.opciones.oro_recursos')
        @includeWhen(Auth::user()->tipo_usuario_id <= 3, 'layouts.partials.opciones.platino_recursos')
        @includeWhen(Auth::user()->tipo_usuario_id <= 2, 'layouts.partials.opciones.diamante_recursos')
    </ul>
</li>
@includeWhen( Auth::user()->es_admin(), 'layouts.partials.opciones.admin')
@includeWhen( Auth::user()->es_admin(), 'layouts.partials.opciones.admin_recursos')

