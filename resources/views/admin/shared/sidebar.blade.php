<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
        <a href="{{route('admin.home')}}" class="site_title"><img src="{{ asset('logo (2).png') }}">
                <span>{{ config('app.name') }}</span></a>
        </div>
        <!-- menu profile quick info -->
    @include('admin.shared.menuProfile')
    <!-- /menu profile quick info -->

        <br/>

        <div class="clearfix"></div>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('admin.home')}}"><i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    @hasanyrole('GERENTE')
                    <li><a href="{{ route('admin.usuarios.index')}}"><i class="fas fa-user-tie"></i> Usuarios
                                                                </a>
                    </li>
                    @endhasanyrole

                    @hasanyrole('GERENTE')
                    <li><a href="{{ route('admin.roles.index')}}"><i class="fas fa-gavel"></i> Roles
                                                                                    </a>
                    </li>
                    @endhasanyrole

                    @hasanyrole('GERENTE|FUNCIONARIO_RRHH')
                    <li><a href="{{ route('admin.areas.index')}}"><i class="fas fa-users"></i> Areas
                                                                                    </a>
                    </li>
                    @endhasanyrole

                    @hasanyrole('GERENTE|FUNCIONARIO_RRHH')
                    <li><a href="{{ route('admin.empleados.index')}}"><i class="fas fa-people-carry"></i> Empleados
                                                                                                        </a>
                    </li>
                    @endhasanyrole

                    @hasanyrole('GERENTE|FUNCIONARIO_RRHH')
                    <li><a href="{{ route('admin.indicadores.index')}}"><i class="fas fa-chart-line"></i> Indicadores
                                                                                                                            </a>
                    </li>
                    @endhasanyrole

                    @hasanyrole('GERENTE|SUPERVISOR')
                    <li><a href="{{ route('admin.evaluacion.areas')}}">
                        <i class="fab fa-rev"></i> Realizar evaluación
                                                                                                                                                </a>
                    </li>
                    @endhasanyrole
                    @hasanyrole('GERENTE|SUPERVISOR')
                    <li><a href="{{ route('admin.reporte.empleados')}}">
                        <i class="fas fa-chart-bar"></i> Reporte empleado
                                                                                                                                                </a>
                    </li>
                    @endhasanyrole
                    @hasanyrole('GERENTE|SUPERVISOR')
                    <li><a href="{{ route('admin.reporte.areas')}}">
                        <i class="fas fa-chart-pie"></i> Reporte área
                                                                                                                                                </a>
                    </li>
                    @endhasanyrole
                </ul>
            </div>


        </div>
    </div>
</div>
