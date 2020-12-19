<!-- Sidebar -->
<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('images') }}/sidebar-1.jpg">
    <!-- Brand Logo -->
    <div class="logo">
        <a class="navbar-brand align-items-center" href="#"><img src="{{ asset('images') }}/logo.png" alt="" style="width: 160px"></a>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar-wrapper">
        <ul class="nav" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <p>
                        <i class="fas fa-fw fa-tachometer-alt">

                        </i>
                        <span>{{ trans('global.dashboard') }}</span>
                    </p>
                </a>
            </li>
            @can('user_edit')
            <li class="nav-item">
                <a href="{{ route('admin.profile.edit')}}" class="nav-link">
                    <p>
                        <i class="fas fa-fw fa-user">

                        </i>
                        <span>{{ __('My Profile') }}</span>
                    </p>
                </a>
            </li>
            @endcan
            @can('user_management_access')
                <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#user_management">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <p>
                            <span>{{ trans('cruds.userManagement.title') }}</span>
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse " id="user_management">
                        <ul class="nav">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-unlock-alt">

                                        </i>
                                        <span>{{ trans('cruds.permission.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-briefcase">

                                        </i>
                                        <span>{{ trans('cruds.role.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-user">

                                        </i>
                                        <span>{{ trans('cruds.user.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
            @can('patient_access')
            <li class="nav-item">
                <a href="{{ route("admin.patients.index") }}" class="nav-link {{ request()->is('admin/patients') || request()->is('admin/patients/*') ? 'active' : '' }}">
                    <p>
                        <i class="material-icons">medical_services</i>

                        <span class="sidebar-normal"> {{ __('Patients Management') }} </span>
                    </p>
                </a>
            </li>
            @endcan
            @can('exercise_access')
                <li class="nav-item">
                    <a href="{{ route("admin.exercises.index") }}" class="nav-link {{ request()->is('admin/exercises') || request()->is('admin/exercises/*') ? 'active' : '' }}">
                        <p>
                            <i class="material-icons">rowing</i>

                            <span class="sidebar-normal"> {{ __('Exercises Management') }} </span>
                        </p>
                    </a>
                </li>
            @endcan
            @can('program_access')
                <li class="nav-item">
                    <a href="{{ route("admin.programs.index") }}" class="nav-link {{ request()->is('admin/programs') || request()->is('admin/programs/*') ? 'active' : '' }}">
                        <p>
                            <i class="material-icons">contact_page</i>

                            <span class="sidebar-normal"> {{ __('Programs Management') }} </span>
                        </p>
                    </a>
                </li>
            @endcan
            @can('workout_access')
                <li class="nav-item">
                    <a href="{{ route("admin.workouts.index") }}" class="nav-link {{ request()->is('admin/workouts') || request()->is('admin/workouts/*') ? 'active' : '' }}">
                        <p>
                            <i class="material-icons">add_task</i>

                            <span class="sidebar-normal"> {{ __('Assign Therapy') }} </span>
                        </p>
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <p>
                        <i class="fas fa-fw fa-sign-out-alt">

                        </i>
                        <span>{{ trans('global.logout') }}</span>
                    </p>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
