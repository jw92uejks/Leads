<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="bingbot" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="slurp" content="noindex, nofollow, noarchive, nosnippet, noimageindex">

    <title>{{ config('app.name', 'Ondeal') }} | @yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom-sidebar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/sidebar-3d.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/submenu-modals.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- AlpineJS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="{{ asset('alpinejs/marketplace-cart.js') }}"></script>
    <!-- page style -->
    @yield('headlocal')
</head>

<body class="antialiased" id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <div id="kt_app_header" class="app-header " data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false" style="top: 0px;" data-kt-sticky-enabled="true">
                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
                    <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                            <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    @include('layouts.peaks.topnav')
                </div>
            </div>

            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include('layouts.peaks.sidebar')
                <!-- ============================================================== -->

                <div class="app-main flex-column flex-row-fluid" id="kt_app_main" style="overflow-x: hidden">
                    @yield('content')
                    @include('layouts.peaks.footer')
                </div>

                <!-- ============================================================== -->
            </div>
        </div>
    </div>

    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('assets/js/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <!-- page JS -->
    @yield('jslocal')
    @stack('modals')
</body>

</html>

