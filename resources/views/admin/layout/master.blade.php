<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>DTAIL | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Datatables css -->
    <link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}">

    <!-- Vector Map css -->
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/hyper-config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('assets/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom CSS-->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('admin.layout.navbar')
        @include('admin.layout.sidebar')
        <div class="content-page">
            @yield('content')
            @include('admin.layout.footer')
        </div>
        @include('admin.layout.theme')
    </div>
    @include('admin.layout.footer_links')
    @stack('scripts')
</body>

</html>
