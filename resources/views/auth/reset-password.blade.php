<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>{{ config('app.name', 'Nice-API') }} | Redefinir Senha</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="{{asset('assets/media/logos/nicelogo.ico')}}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<style>
			body {background-image: url("{{asset('assets/media/auth/bg9-dark.jpg')}}");}
			[data-bs-theme="dark"] body {background-image: url("{{asset('assets/media/auth/bg9-dark.jpg')}}");}
		</style>

		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<div class="d-flex flex-lg-row-fluid">
				<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
					<img class="theme-light-show mx-auto mw-100 w-150px w-lg-200px mb-10 mb-lg-20" src="{{asset('assets/media/auth/nicelogo.png')}}" alt="" />
					<img class="theme-dark-show mx-auto mw-100 w-150px w-lg-200px mb-10 mb-lg-20" src="{{asset('assets/media/auth/nicelogo.png')}}" alt="" />
					<h1 class="text-gray-200 fs-3qx fw-bold text-center mb-7">Nice Api</h1>
				</div>
			</div>
			<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
				<div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
					<div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
						<div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
							<form class="form w-100" action="{{ route('password.store') }}" method="POST" id="kt_sign_in_form">
                                @csrf
								<input type="hidden" name="token" value="{{ $request->route('token') }}">
								<div class="text-center mb-11">
									<h1 class="text-dark fw-bolder mb-3">Redefinir Senha</h1>
									<div class="text-gray-500 fw-semibold fs-6">
										Informe suas novas credenciais
									</div>
                                    @if ($errors->any())
									<div class="d-flex justify-content-center">
										<div class="alert alert-danger d-flex align-items-center px-10 py-3 mt-5 text-center">
											<div class="d-flex flex-column">
												<h4 class="my-2 text-danger">Atenção!</h4>
												@foreach ($errors->all() as $error)
													<p>{{ $error }}</p>
												@endforeach
											</div>
										</div>
									</div>
									@endif
								</div>

								<div class="fv-row mb-8">
									<input type="email" placeholder="Email" name="email" value="{{ old('email', $email ?? '') }}" class="form-control bg-transparent @error('email') is-invalid @enderror" autocomplete="email" />
								</div>

								<div class="fv-row mb-8">
									<input type="password" name="password" class="form-control bg-transparent @error('password') is-invalid @enderror" placeholder="Nova senha" autocomplete="new-password" />
								</div>

								<div class="fv-row mb-8">
									<input type="password" name="password_confirmation" class="form-control bg-transparent" placeholder="Confirmar nova senha" autocomplete="new-password" />
								</div>

								<div class="d-grid mb-10">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
										<span class="indicator-label">Redefinir Senha</span>
										<span class="indicator-progress">Redefinindo senha...
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
										</span>
									</button>
								</div>

								<div class="text-gray-500 text-center fw-semibold fs-6">
									Lembrou sua senha?
									<a href="{{ route('login') }}" class="link-primary">Voltar ao Login</a>
								</div>
							</form>
						</div>
						<div class="d-flex flex-stack">
							<div class="me-10">
								<button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
									<img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="{{asset('assets/media/flags/brazil.svg')}}" alt="" />
									<span data-kt-element="current-lang-name" class="me-1">Português</span>
								</button>
							</div>
							<div class="d-flex fw-semibold text-primary fs-base gap-5">
								<a href="#" data-bs-toggle="modal" data-bs-target="#termos">Termos</a>
								<a href="#" data-bs-toggle="modal" data-bs-target="#politicas">Planos</a>
								<a href="#" target="_blank">Contatos</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('components.modals.terms')
	@include('components.modals.policies')
	@include('components.alert')

	<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
	<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
	<script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>
</body>
</html>
