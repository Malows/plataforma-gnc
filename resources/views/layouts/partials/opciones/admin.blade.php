<li class="treeview">
    <a href="#"><i class='fa fa-link'></i> <span>Administrador</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ route('tickets.index') }}">{{ trans('message.tickets') }}</a></li>
        <li><a href="{{ route('usuarios.index') }}">{{ trans('message.usuarios') }}</a></li>
        <li><a href="{{ route('tipo_de_usuarios.index') }}">{{ trans('message.tipo_de_usuarios') }}</a></li>
    </ul>

</li>