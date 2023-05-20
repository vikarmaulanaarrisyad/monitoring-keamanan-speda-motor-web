<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="icon" href="#" type="image/*">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAler2 -->
    <link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/sweetalert2/sweetalert2.min.css') }}">

    @stack('css_vendor')
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/AdminLTE') }}/dist/css/adminlte.min.css">
    <style>
        .note-editor {
            margin-bottom: 0;
        }

        .note-editor.is-invalid {
            border-color: var(--danger);
        }

        .nav-sidebar .nav-header {
            font-size: .6rem;
            font-weight: bold;
            color: #888;
        }
    </style>
    @stack('css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.partials.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @section('breadcrumb')
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                @show
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Main Footer -->
        @include('layouts.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- sweetalert2 -->
    <script src="{{ asset('/AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    @stack('scripts_vendor')

    <!-- AdminLTE App -->
    <script src="{{ asset('/AdminLTE') }}/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('/js/custom.js') }}"></script>

    @stack('scripts')
</body>

</html>
