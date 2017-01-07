<li class="active">
    <a href="{{ route('dashboard') }}"><i class='fa fa-home'></i> <span>{{ trans('message.home') }}</span></a>
</li>
@if(Auth::user()->id_tipo_usuario <= 6)
    @include('layouts.partials.opciones.bronce')

    @if(Auth::user()->id_tipo_usuario <= 5)
        @include('layouts.partials.opciones.plata')

        @if(Auth::user()->id_tipo_usuario <= 4)
            @include('layouts.partials.opciones.oro')

            @if(Auth::user()->id_tipo_usuario <= 3)
                @include('layouts.partials.opciones.platino')

                @if(Auth::user()->id_tipo_usuario <= 2)
                    @include('layouts.partials.opciones.diamante')

                    @if(Auth::user()->id_tipo_usuario == 1)
                        @include('layouts.partials.opciones.admin')
                    @endif
                @endif
            @endif
        @endif
    @endif
@endif


@if(Auth::user()->id_tipo_usuario <= 6)
    @include('layouts.partials.opciones.bronce_scripts')

    @if(Auth::user()->id_tipo_usuario <= 5)
        @include('layouts.partials.opciones.plata_scripts')

        @if(Auth::user()->id_tipo_usuario <= 4)
            @include('layouts.partials.opciones.oro_scripts')

            @if(Auth::user()->id_tipo_usuario <= 3)
                @include('layouts.partials.opciones.platino_scripts')

                @if(Auth::user()->id_tipo_usuario <= 2)
                    @include('layouts.partials.opciones.diamante_scripts')

                    @if(Auth::user()->id_tipo_usuario == 1)
                        @include('layouts.partials.opciones.admin_scripts')

                    @endif
                @endif
            @endif
        @endif
    @endif
@endif
