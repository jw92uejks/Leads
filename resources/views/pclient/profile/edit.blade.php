@extends('layouts.app')
@section('title', 'Perfil do Usuário')
@section('profile', 'active')

@section('headlocal') @includeIf('pclient.profile.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.profile.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Perfil do Usuário</h1>
                <span class="text-muted">Gerencie suas informações pessoais</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="app-container container-fluid">
            <form id="profile-form" class="row g-5 g-xl-8" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="col-xl-4">
                    <div class="card card-flush h-100">
                        <div class="card-body text-center d-flex flex-column justify-content-center">
                            <div class="position-relative mb-7">
                                <div class="symbol symbol-100px symbol-circle">
                                    <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('assets/images/avatars/blank.png') }}" alt="Avatar do usuário" id="user-avatar" />
                                </div>
                            </div>
                            <h4 class="fw-bold text-dark mb-2" id="user-name">{{ $user->name }}</h4>
                            <div class="text-muted mb-4" id="user-email">{{ $user->email }}</div>
                            <div class="d-flex justify-content-center mb-4">
                                <div class="position-relative">
                                    <input type="file" class="btn btn-sm btn-light-primary border-1 rounded-2 p-4" name="avatar" accept="image/*" style="position: relative; opacity: 1; cursor: pointer;" />
                                    <div class="form-text text-center mt-2">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card card-flush h-100">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold">Editar Perfil</h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{ route('profile.index') }}" class="btn btn-sm btn-light-secondary">
                                    <i class="ki-duotone ki-arrow-left fs-6 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Voltar
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-9 mb-7">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Nome Completo</label>
                                    <input type="text" class="form-control form-control-solid" name="name" value="{{ $user->name }}" placeholder="Seu nome completo" required />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">E-mail</label>
                                    <input type="email" class="form-control form-control-solid" name="email" value="{{ $user->email }}" placeholder="seu@email.com" required />
                                </div>
                            </div>

                            <div class="row g-9 mb-7">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Telefone</label>
                                    <input type="tel" class="form-control form-control-solid" name="phone" value="{{ $user->phone }}" placeholder="(11) 99999-9999" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Api Token</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control form-control-solid" name="ucode" value="{{ $user->ucode }}" placeholder="username" readonly />
                                        <button type="button" class="btn btn-icon btn-xs btn-light-primary position-absolute top-50 end-0 translate-middle-y me-2" id="regenerate-token" title="Gerar Novo Token">
                                            <i class="fas fa-random fs-8"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-9 mb-7">
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Tipo de Documento</label>
                                    <select class="form-select form-select-solid" name="type" id="document-type-select">
                                        <option value="">Selecione o tipo</option>
                                        <option value="1" {{ $user->type?->value === 1 ? 'selected' : '' }}>CPF</option>
                                        <option value="2" {{ $user->type?->value === 2 ? 'selected' : '' }}>CNPJ</option>
                                        <option value="3" {{ $user->type?->value === 3 ? 'selected' : '' }}>Adesão</option>
                                    </select>
                                </div>
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">CPF</label>
                                    <input type="text" class="form-control form-control-solid" name="cpf" id="cpf-input" value="{{ $user->cpf }}" placeholder="000.000.000-00" maxlength="14" />
                                </div>
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">CNPJ</label>
                                    <input type="text" class="form-control form-control-solid" name="cnpj" id="cnpj-input" value="{{ $user->cnpj }}" placeholder="00.000.000/0000-00" maxlength="18" />
                                </div>
                            </div>

                            <div class="separator my-8"></div>

                            <div class="row g-9 mb-7">
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Senha Atual</label>
                                    <input type="password" class="form-control form-control-solid" name="current_password" placeholder="Digite sua senha atual" />
                                </div>
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nova Senha</label>
                                    <input type="password" class="form-control form-control-solid" name="password" placeholder="Digite a nova senha" />
                                </div>
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Confirmar Nova Senha</label>
                                    <input type="password" class="form-control form-control-solid" name="password_confirmation" placeholder="Confirme a nova senha" />
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('profile.index') }}" class="btn btn-light btn-small me-3">Cancelar</a>
                                <button type="submit" class="btn btn-primary btn-small" id="save-btn">
                                    <span class="indicator-label">Salvar Alterações</span>
                                    <span class="indicator-progress">Aguarde...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@include('components.alert')
@endsection