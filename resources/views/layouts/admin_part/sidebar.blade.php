@php $menu = app()->make('admin.sidebar.render'); @endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('assets/adminlte3/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME', 'BookStore') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image mt-2">
                <img src="{{ asset('assets/adminlte3/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Example Admin</a>
                <a href="#"><small>Logout</small></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- Menu Main Group --}}
                {!! $menu['menuMainGroup'] !!}

                {{-- Menu Extension Group --}}
                {!! $menu['menuExtGroup'] !!}

                {{-- Menu Other Group --}}
                <li class="nav-header">Other</li>
                {!! $menu['menuOthGroup'] !!}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>