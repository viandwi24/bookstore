<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('meta')
    <title>{{ env('APP_NAME', 'BookStore') }}</title>
    @include('layouts.admin_part.css')
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    @include('layouts.admin_part.navbar')

    <!-- Main Sidebar Container -->
    @include('layouts.admin_part.sidebar')

    @yield('content')

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2020 <a href="https://viandwi24.github.io">VianDwi24</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>

    <!-- Scripts -->
    @include('layouts.admin_part.js')
    @stack('scripts')
</body>
</html>