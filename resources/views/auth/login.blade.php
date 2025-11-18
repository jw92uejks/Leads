<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'SecretárIA') }} | Login</title>
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
                        <form class="form w-100" id="kt_sign_in_form" method="POST" action="{{ route('login') }}">
                            @csrf
                            @method('POST')
                            <div class="text-center mb-11">
                                <x-layered-text content="Login" />
                                <div class="text-gray-500 fw-semibold fs-6">Sua assistente virtual para corretores de imóveis</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="off" class="form-control  @error('email') is-invalid @enderror" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="fv-row mb-3">
                                <input type="password" placeholder="Senha" name="password" value="{{ old('password') }}" autocomplete="off" class="form-control @error('password') is-invalid @enderror" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="fv-row mb-8">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input @error('remember') is-invalid @enderror" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                    <label class="form-check-label fw-semibold text-gray-700 fs-base ms-1">Lembrar de mim</label>
                                </label>
                                @error('remember')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <a href={{ route('password.request') }} class="link-primary">Esqueceu a senha?</a>
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <span class="indicator-label">Entrar</span>
                                    <span class="indicator-progress">Entrando...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <div class="text-gray-500 text-center fw-semibold fs-6">Ainda não tem uma conta?
                                <a href="{{ route('register') }}" class="link-primary">Cadastre-se</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('auth.peaks.side')
        </div>

        @include('components.modals.terms')
        {{--
        @include('components.modals.policies')
		--}}
        @include('components.alert')

        <script src="{{ asset('assets/js/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/auth/login.js') }}"></script>
</body>

</html>

