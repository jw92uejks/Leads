@extends('layouts.app')
@section('title', 'Criar Nova Equipe')
@section('team-panel', 'active')

@section('headlocal') @includeIf('pclient.team-panel.jscss.css') @endsection
{{-- JavaScript removido - implementar funcionalidades no backend --}}

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Criar Nova Equipe</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Início</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('team-panel.index') }}" class="text-muted text-hover-primary">Painel da Equipe</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Criar Equipe</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('team-panel.index') }}" class="btn btn-light-secondary">
                        <i class="ki-duotone ki-arrow-left fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>Voltar
                    </a>
                </div>
            </div>
        </div>

        <div id="kt_app_content_container" class="app-container">
            <!--begin::Formulário de Criação-->
            <div class="card card-flush">
                <div class="card-header pt-8">
                    <h3 class="card-title">Informações da Nova Equipe</h3>
                </div>
                <div class="card-body">
                    <form id="kt_create_team_form" class="form">
                        <div class="row g-6">
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Nome da Equipe</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="team_name" placeholder="Ex: Equipe Alpha" required />
                                    <div class="form-text">Escolha um nome único e descritivo para sua equipe</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Proprietário</span>
                                    </label>
                                    <div class="d-flex align-items-center p-3 border rounded bg-light-primary" style="height: 42px;">
                                        <div class="symbol symbol-35px symbol-circle me-3">
                                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="{{ auth()->user()->name ?? 'Usuário' }}" />
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center">
                                            <div class="fw-bold text-dark fs-6 me-3">{{ auth()->user()->name ?? 'Usuário Logado' }}</div>
                                            <div class="text-dark fs-7" style="color: #A11753 !important;">{{ auth()->user()->email ?? 'usuario@email.com' }}</div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="team_owner" value="{{ auth()->id() ?? 1 }}" />
                                    <div class="form-text">Você será o proprietário desta equipe</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mb-2">Descrição</label>
                                    <textarea class="form-control form-control-solid" name="team_description" rows="3" placeholder="Descreva a função, objetivos e especialização da equipe"></textarea>
                                    <div class="form-text">Uma descrição clara ajuda outros usuários a entenderem o propósito da equipe</div>
                                </div>
                            </div>

                        </div>

                        <div class="separator my-10"></div>

                        <div class="row g-6">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between mb-6">
                                    <div>
                                        <h3 class="card-title mb-2">Convidar Membros</h3>
                                        <p class="text-muted mb-0">Adicione membros à sua equipe. Se o usuário já estiver cadastrado, será vinculado automaticamente. Caso contrário, um convite será enviado por email.</p>
                                    </div>
                                    <div class="d-flex align-items-end gap-3" style="min-width: 450px;">
                                        <div class="flex-grow-1">
                                            <label class="fs-6 fw-semibold form-label mb-2">Email do Membro</label>
                                            <input type="email" class="form-control form-control-solid" id="member_email" placeholder="exemplo@email.com" />
                                        </div>
                                        <div>
                                            <label class="fs-6 fw-semibold form-label mb-2">&nbsp;</label>
                                            <button type="button" class="btn btn-primary" id="add_member_btn">
                                                <i class="ki-duotone ki-plus fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>Adicionar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Lista de membros convidados -->
                            <div class="col-12">
                                <div id="invited_members_list" class="mb-6">
                                    <!-- Exemplo de membros já convidados (será removido em produção) -->
                                    <div class="card card-flush mb-4" id="member_example_1">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px symbol-circle me-4">
                                                        <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Avatar" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-bold text-dark">Ana Lima</div>
                                                        <div class="text-muted fs-7">ana@email.com</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-success me-3">
                                                        <i class="ki-duotone ki-check-circle fs-6 me-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        Usuário Cadastrado
                                                    </span>
                                                    <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="removeMember('member_example_1')">
                                                        <i class="ki-duotone ki-trash fs-3">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card card-flush mb-4" id="member_example_2">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px symbol-circle me-4">
                                                        <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Avatar" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-bold text-dark">novo@email.com</div>
                                                        <div class="text-muted fs-7">novo@email.com</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-warning me-3">
                                                        <i class="ki-duotone ki-clock fs-6 me-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        Convite Pendente
                                                    </span>
                                                    <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="removeMember('member_example_2')">
                                                        <i class="ki-duotone ki-trash fs-3">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center pt-15">
                            <a href="{{ route('team-panel.index') }}" class="btn btn-light me-3">
                                <i class="ki-duotone ki-arrow-left fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Criar Equipe</span>
                                <span class="indicator-progress">
                                    Aguarde... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Formulário de Criação-->


        </div>
    </div>

    {{-- Modais removidos - implementar funcionalidades no backend --}}
@endsection
