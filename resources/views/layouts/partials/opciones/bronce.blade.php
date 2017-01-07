<li><a href="{{ route('vehiculos.index') }}"><i class='fa fa-link'></i> <span>{{ trans('message.vehiculos') }}</span></a></li>
<li><a href="{{ route('titulares.index') }}"><i class='fa fa-link'></i> <span>{{ trans('message.titulares') }}</span></a></li>

<li class="treeview">
    <a href="#"><i class='fa fa-link'></i> <span>Recursos</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ route('localidades.index') }}">{{ trans('message.localidades') }}</a></li>
        <li><a href="{{ route('modelos_de_autos.index') }}">{{ trans('message.modelos_de_autos') }}</a></li>
        <li><a href="{{ route('marcas_de_autos.index') }}">{{ trans('message.marcas_de_autos') }}</a></li>
    </ul>
</li>