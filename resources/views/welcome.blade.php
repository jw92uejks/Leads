<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ config('app.name', 'Ondeal') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_app_body" style="background: #13263C" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <div class="landing-dark-bg">
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="mb-0" id="home">
                <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url({{ asset('assets/images/medtrations/landing.svg') }})">
                    <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                        <div class="container">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center flex-equal">
                                    <a href="{{ route('dashboard') }}">
                                        <img alt="Logo" src="{{ asset('assets/logo.png') }}" class="logo-default h-25px h-lg-50px" />
                                        <img alt="Logo" src="{{ asset('assets/logo.png') }}" class="logo-sticky h-20px h-lg-50px" />
                                    </a>
                                </div>
                                <div class="flex-equal text-end ms-1">
                                    <a href="{{ route('login') }}" class="btn btn-primary">Entrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
                        <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20  mw-800px">
                            <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-5">Com a
                                <span style="background: linear-gradient(to right, #a01c7f 0%, #e71d73 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                                    <span id="kt_landing_hero_text">SecretarIA do Corretor</span>
                                </span> você tem estrutura de verdade pra organizar a rotina.
                            </h1>
                            <p class="text-white fs-lg-2x text-center mb-15">
                                Deixe ela atender seus clientes e foque no que realmente importa: vender.
                            </p>

                        </div>
                        <div class="d-flex flex-center flex-wrap position-relative px-5">
                            <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Fujifilm">
                                <img src="{{ asset('assets/images/svg/fujifilm.svg') }}" class="mh-30px mh-lg-40px" alt="" />
                            </div>

                            <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Vodafone">
                                <img src="{{ asset('assets/images/svg/vodafone.svg') }}" class="mh-30px mh-lg-40px" alt="" />
                            </div>

                            <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="KPMG International">
                                <img src="{{ asset('assets/images/svg/kpmg.svg') }}" class="mh-30px mh-lg-40px" alt="" />
                            </div>

                            <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Nasa">
                                <img src="{{ asset('assets/images/svg/nasa.svg') }}" class="mh-30px mh-lg-40px" alt="" />
                            </div>

                            <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Aspnetzero">
                                <img src="{{ asset('assets/images/svg/aspnetzero.svg') }}" class="mh-30px mh-lg-40px" alt="" />
                            </div>

                            <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="AON - Empower Results">
                                <img src="{{ asset('assets/images/svg/aon.svg') }}" class="mh-30px mh-lg-40px" alt="" />
                            </div>

                            <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Hewlett-Packard">
                                <img src="{{ asset('assets/images/svg/hp-3.svg') }}" class="mh-30px mh-lg-40px" alt="" />
                            </div>

                            <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Truman">
                                <img src="{{ asset('assets/images/svg/truman.svg') }}" class="mh-30px mh-lg-40px" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-0 mt-20">
                <div class="landing-dark-bg pt-20">
                    <div class="landing-dark-separator"></div>
                    <div class="container">
                        <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                            <div class="d-flex align-items-center justify-content-center order-2 order-md-1 m-auto">
                                <a href="{{ route('dashboard') }}">
                                    <img alt="Logo" src="{{ asset('assets/logo-icon.png') }}" class="h-30px" />
                                </a>
                                <span class="mx-5 fs-6 fw-semibold text-gray-600 pt-1" href="{{ route('dashboard') }}">&copy; 2025 SecretárIA do Corretor.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
