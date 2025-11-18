<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'SecretárIA') }} | Recuperar Senha</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1" style="position: relative; background-repeat: no-repeat; overflow: hidden;  background-position: top right; background-size: 150%;">
                <img src="{{ asset('assets/images/logo-6.png') }}" style="position: absolute; transform: rotate(-35deg); opacity: 0.02; width: 1420px; top: 1/2; left: 1/2; pointer-events: none;" />
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px">
                        <form class="form w-100" action="{{ route('password.email') }}" method="POST" id="kt_password_reset_form">
                            @csrf
                            <div class="text-center mb-10">
                                <h1 class="text-dark fw-bolder mb-3">Esqueceu a Senha?</h1>
                                <div class="text-gray-500 fw-semibold fs-6">Insira seu Email para resetar sua Senha.</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input class="form-control" type="email" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}" required />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary btn-sm me-4">
                                    <span class="indicator-label">Enviar</span>
                                    <span class="indicator-progress">Enviando email...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">Voltar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('auth.peaks.side')
        </div>

        {{--
        @include('components.modals.terms')
        @include('components.modals.policies')
		--}}
        @include('components.alert')

        <script src="{{ asset('assets/js/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/auth/reset.js') }}"></script>
</body>

</html>

