<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">{{ trans('message.need_some_help') }}</h3>
            <ul class='control-sidebar-menu'>
                <li>
                    <a href='{{ route('base_de_conocimientos') }}'>
                        <i class="menu-icon fa fa-university bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">{{ trans('message.knowledge_base') }}</h4>
                            <p>{{ trans('message.Knowledge_base_description') }}</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='{{ route('tickets.index') }}'>
                        <i class="menu-icon fa fa-question bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">{{ trans('message.write_a_ticket_for_help') }}</h4>
                            <p>{{ trans('message.we_will_awnser_soon') }}</p>
                        </div>
                    </a>
                </li>
            </ul><!-- /.control-sidebar-menu -->
            @if( ! Auth::user()->es_admin() )
            <h3 class="control-sidebar-heading">{{ trans('message.license') }}</h3>
            <ul class='control-sidebar-menu'>
                <li>
                    <a href='#'>
                        <h4 class="control-sidebar-subheading">
                            {{ trans('message.days_left_of_license') }}
                            <span class="label label-danger pull-right">{{ Auth::user()->dias_restantes_de_licencia() }}</span>
                        </h4>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: {{ 100 * ( Auth::user()->dias_restantes_de_licencia() / Auth::user()->duracion_de_licencia ) }}%"></div>
                        </div>
                    </a>
                </li>
            </ul><!-- /.control-sidebar-menu -->
            @endif

        </div><!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">{{ trans('adminlte_lang::message.statstab') }}</div><!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">

            <form method="post">
                <h3 class="control-sidebar-heading">{{ trans('adminlte_lang::message.generalset') }}</h3>
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        {{ trans('adminlte_lang::message.reportpanel') }}
                        <input type="checkbox" class="pull-right" {{ trans('adminlte_lang::message.checked') }} />
                    </label>
                    <p>
                        {{ trans('adminlte_lang::message.informationsettings') }}
                    </p>
                </div><!-- /.form-group -->
            </form>
        </div><!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar

<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>