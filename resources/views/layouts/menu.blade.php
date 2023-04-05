<nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Rana MIS
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @can('branch.view',Auth::user())

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            Branch <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('/branch')}}">Branch List</a></li>
                            <li role="separator" class="divider"></li>
                                @can('branch.create',Auth::user())
                            <li><a href="{{url('/branch/create')}}">Create New branch</a></li>
                            <li role="separator" class="divider"></li>

                                @endcan
                            <li><a href="{{url('/department')}}">Department List</a></li>
                            <li role="separator" class="divider"></li>

                            <li><a href="{{url('/department/create')}}">Create New Department</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('user.create',Auth::user())

                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            Users <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('/user')}}">User List</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('register') }}">Register New User</a></li>
                         <li role="separator" class="divider"></li>
                            <li><a href="{{ route('role.index') }}">User Roles</a></li>
                            <li><a href="{{ route('role.create') }}">Create New User Roles</a></li>
                         <li role="separator" class="divider"></li>
                            <li><a href="{{ route('permission.index') }}">User Role Permissions</a></li>

                            <li><a href="{{ route('permission.create') }}">Create New Permission</a></li>
                        </ul>
                    </li>
                    @endcan






                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            Test <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('/test')}}">Test list</a></li>
                            @can('test.create',Auth::user())

                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('/test/create')}}">Add new test</a></li>

                    @endif
                        </ul>
                    </li>

                    @if (Auth::user()->can('pacient.create') || Auth::user()->can('add_test') )

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            Pacient<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @can('pacient.create',Auth::user())
                            <li><a href="{{ route('pacient.create') }}">Register New Pacient</a></li>
                            @endcan
                            <li role="separator" class="divider"></li>
                                @can('add_test',Auth::user())

                            <li><a href="{{url('/pacient')}}">Add Test Result</a></li>
                            <li role="separator" class="divider"></li>
                                @endcan

                            <li><a href="{{ route('showAllPacientlist') }}">All patient list</a></li>
                        </ul>
                    </li>
                        @endcan
                    @can('material.view',Auth::user())

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            Stock <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('/material')}}">All item list</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('/material/create')}}">Add new item</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('lessmaterial')}}">Less item list</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('doctor.view',Auth::user())

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            Doctors<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('/doctor')}}">All doctors List</a></li>
                            @can('doctor.create',Auth::user())

                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('/doctor/create')}}">Add new Doctor</a></li>
                                @endcan
                        </ul>
                    </li>
                    @endcan

                        @if (Auth::user()->can('today_report') || Auth::user()->can('tabular_report') || Auth::user()->can('sale_summary'))
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            Reports<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @can('today_report',Auth::user())

                            <li><a href="{{ route('today.report') }}">Today report</a></li>
                            <li role="separator" class="divider"></li>
                            @endcan
                            @can('tabular_report',Auth::user())

                            <li><a href="{{ route('tabular.form') }}">Tabular Report</a></li>
                            <li role="separator" class="divider"></li>
                            @endcan
                                @can('sale_summary',Auth::user())

                            <li><a href="{{ route('ss.form') }}">Sale Summary</a></li>
                                @endcan
                        </ul>
                    </li>
                        @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{url('changePassword')}}">
                                        <i class="glyphicon glyphicon-edit"></i>Reset Password
                                    </a>
                                </li>
                                <li>
                                    <a href="#" 
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="glyphicon glyphicon-off"></i> Logout
                                    </a>
                                     <form id="logout-form" action="{{route('logout')}}" method="post">
                                            {{csrf_field()}}
                                      </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                </ul>

            </div>
        </div>
</nav>