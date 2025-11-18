<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'SecretárIA') }} | Registro</title>
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
                <img src="{{ asset('assets/images/logo-6.png') }}" style="position: absolute; transform: rotate(-35deg); opacity: 0.02; width: 1420px; top: 1/2; left: 1/2; pointer-events: none; z-index: -1;" />
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px">
                        <form class="form w-100 position-relative z-3" method="POST" action="{{ route('register') }}" id="kt_sign_up_form" data-kt-redirect-url={{route('homepage.index')}}>
                            @csrf
                            <div class="text-center mb-11">
                                <x-layered-text content="Registro" />
                                <div class="text-gray-500 fw-semibold fs-6">Digite as credenciais para cadastro</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" class="form-control bh-white @error('name') is-invalid @enderror" placeholder="Nome completo" name="name" value="{{ old('name') }}" autocomplete="off" />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="new-email" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Nº celular com DDD" name="phone" value="{{ old('phone') }}" />
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <div class="mb-1">
                                    <div class="position-relative mb-3">
                                        <input type="password" class="form-control" placeholder="Senha" name="password" value="" autocomplete="new-password" />
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                            <i class="ki-duotone ki-eye-slash fs-2"></i>
                                            <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                </div>
                                <div class="text-muted">Sua senha deve ter no mínimo 8 caracteres, incluindo letras maiúsculas, minúsculas, números e símbolos.</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Repetir Senha" value="" autocomplete="off" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="fv-row mb-8">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input @error('toc') is-invalid @enderror" type="checkbox" name="toc" value="1" id="check-toc" />
                                    <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">Eu aceito todos os <a href="#" data-bs-toggle="modal" data-bs-target="#termos" class="ms-1 link-primary">Termos & condições</a></span>
                                </label>
                                @error('toc')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_up_submit" class="btn btn-primary" disabled>
                                    <span class="indicator-label">Cadastrar</span>
                                    <span class="indicator-progress">Cadastrando...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <div class="text-gray-500 text-center fw-semibold fs-6">
                                Já possui um cadastro?
                                <a href="{{ route('login') }}" class="link-primary fw-semibold">Logar</a>
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
        <script>
            (function(){
                const checkbox = document.getElementById('check-toc');
                const submitBtn = document.getElementById('kt_sign_up_submit');
                if (checkbox && submitBtn) {
                    const toggle = () => {
                        submitBtn.disabled = !checkbox.checked;
                    };
                    toggle();
                    checkbox.addEventListener('change', toggle);
                }
            })();
        </script>
</body>

</html>

