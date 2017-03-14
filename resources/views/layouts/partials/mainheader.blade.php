<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">{{ trans('message.platform_nickname') }}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{ trans('message.platform_title') }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">{{ $mensajes->count() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">{{ trans_choice('message.n_messages_to_read', $mensajes->count(), ['count' => $mensajes->count()] ) }}</li>
                        <li>
                            <!-- inner menu: contains the messages -->
                            <ul class="menu">
                                @foreach( $mensajes as $msg )
                                <li><!-- start message -->
                                    <a href="{{ route('mensajes.show', $msg) }}">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <img src="{{ Gravatar::get($msg->from->email) }}" class="img-circle" alt="User Image"/>
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>
                                            {{ strlen($msg->asunto) > 29 ? substr($msg->asunto,0,26)."..." : $msg->asunto }}
                                            <small><i class="fa fa-clock-o"></i> {{ $msg->created_at->diffForHumans() }}</small>
                                        </h4>
                                        <!-- The message -->
                                        <p>{{ strlen($msg->mensaje) > 31 ? substr($msg->mensaje, 0, 28)."..." : $msg->mensaje }}</p>
                                    </a>
                                </li><!-- end message -->
                                @endforeach
                            </ul><!-- /.menu -->
                        </li>
                        <li class="footer"><a href="{{ route('mensajes.index') }}">{{ trans('message.viewall') }}</a></li>
                    </ul>
                </li><!-- /.messages-menu -->
                @if( Auth::user()->es_admin() )
                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">{{ $tickets->count() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">{{ trans_choice('message.n_notifications', $tickets->count(),['count' => $tickets->count()]) }}</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                @foreach( $tickets as $ticket)
                                <li><!-- start notification -->
                                    <a href="{{ route('tickets.show', $ticket) }}">
                                        <i class="fa fa-bell"></i> {{ $ticket->mensaje }}
                                    </a>
                                </li><!-- end notification -->
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="{{ route('tickets.index') }}">{{ trans('message.viewall') }}</a></li>
                    </ul>
                </li>
                @endif
                <!-- Tasks Menu -->
                <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">{{ trans('message.tasks') }}</li>
                        <li>
                            <!-- Inner menu: contains the tasks -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <!-- Task title and progress text -->
                                        <h3>
                                            {{ trans('message.tasks') }}
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <!-- The progress bar -->
                                        <div class="progress xs">
                                            <!-- Change the css width attribute to simulate progress -->
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% {{ trans('message.complete') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">{{ trans('message.alltasks') }}</a>
                        </li>
                    </ul>
                </li>
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">{{ trans('message.login') }}</a></li>
                @else
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ trans('message.login') }} Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('message.followers') }}</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('message.sales') }}</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('message.friends') }}</a>
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ url('/settings') }}" class="btn btn-default btn-flat">{{ trans('message.profile') }}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ trans('message.signout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
