<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            @if (Auth::user()->hasRole('Admin'))
                <a class="nav-link " href="{{ route('home') }}">
                    <i class="bi bi-grid"></i>
                    <span>{{ __('Dashboard') }}</span>
                </a>
            @else
                <a class="nav-link " href="{{ route('employeeDashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>{{ __('Dashboard') }}</span>
                </a>
            @endif
        </li><!-- End Dashboard Nav -->
        @if (Auth::user()->hasRole('Admin'))
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>{{ __('User Management') }}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('roles.index') }}">
                            <i class="bi bi-circle"></i><span>{{ __('Roles') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="bi bi-circle"></i><span>{{ __('Users') }}</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->
        @endif

        @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Employee'))
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>{{ __('Leaves') }}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('leaves.index') }}">
                            <i class="bi bi-circle"></i><span>{{ __('Leave') }}</span>
                        </a>
                    </li> 
                </ul>
            </li><!-- End Forms Nav -->
        @endif 
    </ul>

</aside>
