@extends('layouts.app')
@section('title', 'Perfil da Empresa')
@section('company-profile', 'active')

@section('headlocal') @includeIf('pclient.company-profile.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.company-profile.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Perfil da Empresa</h1>
                <span class="text-muted">Gerencie as informações da sua empresa</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="app-container container-fluid">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold">Informações Gerais</h3>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div class="symbol symbol-100px symbol-circle mb-7">
                                <img src="{{ asset('assets/images/placeholders/logo__0001_Ello-Budget.png') }}" alt="Logo da empresa" />
                            </div>
                            
                            <h4 class="fw-bold text-dark mb-2">{{ $supplier->name ?? 'Nome da Empresa' }}</h4>
                            <div class="text-muted mb-4">{{ $supplier->classification ?? 'Classificação' }}</div>
                            
                            <div class="d-flex justify-content-center mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="ki-duotone ki-star fs-5 {{ ($supplier->rating ?? 0) >= $i ? 'text-warning' : 'text-gray-300' }}">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                @endfor
                                <span class="text-muted ms-2">({{ $supplier->rating ?? 0 }}/5)</span>
                            </div>

                            <div class="badge badge-light-{{ $supplier->status === 'approved' ? 'success' : 'warning' }} fs-7 fw-bold mb-4">
                                {{ $supplier->status === 'approved' ? 'Aprovado' : 'Pendente' }}
                            </div>

                            <div class="separator my-4"></div>

                            <div class="row g-0">
                                <div class="col-6 border-end">
                                    <div class="fw-bold text-dark fs-4">{{ $supplier->leads()->count() ?? 0 }}</div>
                                    <div class="text-muted fs-7">Leads Criados</div>
                                </div>
                                <div class="col-6">
                                    <div class="fw-bold text-dark fs-4">R$ 12.450</div>
                                    <div class="text-muted fs-7">Faturamento</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card card-flush">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold">Dados da Empresa</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="company-form" action="{{ route('company-profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Nome da Empresa</label>
                                        <input type="text" class="form-control form-control-solid" name="name" value="{{ $supplier->name ?? '' }}" placeholder="Nome da empresa" required />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">CNPJ</label>
                                        <input type="text" class="form-control form-control-solid" name="cnpj" value="{{ $supplier->cnpj ?? '' }}" placeholder="00.000.000/0000-00" required />
                                    </div>
                                </div>

                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Classificação</label>
                                        <select class="form-select form-select-solid" name="classification">
                                            <option value="">Selecione a classificação</option>
                                            <option value="Premium" {{ ($supplier->classification ?? '') === 'Premium' ? 'selected' : '' }}>Premium</option>
                                            <option value="Gold" {{ ($supplier->classification ?? '') === 'Gold' ? 'selected' : '' }}>Gold</option>
                                            <option value="Silver" {{ ($supplier->classification ?? '') === 'Silver' ? 'selected' : '' }}>Silver</option>
                                            <option value="Bronze" {{ ($supplier->classification ?? '') === 'Bronze' ? 'selected' : '' }}>Bronze</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Telefone</label>
                                        <input type="text" class="form-control form-control-solid" name="phone" value="{{ $supplier->phone ?? '' }}" placeholder="(11) 99999-9999" required />
                                    </div>
                                </div>

                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Cidade</label>
                                        <input type="text" class="form-control form-control-solid" name="city" value="{{ $supplier->city ?? '' }}" placeholder="Cidade" required />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Estado</label>
                                        <select class="form-select form-select-solid" name="state" required>
                                            <option value="">Selecione o estado</option>
                                            <option value="AC" {{ ($supplier->state ?? '') === 'AC' ? 'selected' : '' }}>Acre</option>
                                            <option value="AL" {{ ($supplier->state ?? '') === 'AL' ? 'selected' : '' }}>Alagoas</option>
                                            <option value="AP" {{ ($supplier->state ?? '') === 'AP' ? 'selected' : '' }}>Amapá</option>
                                            <option value="AM" {{ ($supplier->state ?? '') === 'AM' ? 'selected' : '' }}>Amazonas</option>
                                            <option value="BA" {{ ($supplier->state ?? '') === 'BA' ? 'selected' : '' }}>Bahia</option>
                                            <option value="CE" {{ ($supplier->state ?? '') === 'CE' ? 'selected' : '' }}>Ceará</option>
                                            <option value="DF" {{ ($supplier->state ?? '') === 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                            <option value="ES" {{ ($supplier->state ?? '') === 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                            <option value="GO" {{ ($supplier->state ?? '') === 'GO' ? 'selected' : '' }}>Goiás</option>
                                            <option value="MA" {{ ($supplier->state ?? '') === 'MA' ? 'selected' : '' }}>Maranhão</option>
                                            <option value="MT" {{ ($supplier->state ?? '') === 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                            <option value="MS" {{ ($supplier->state ?? '') === 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                            <option value="MG" {{ ($supplier->state ?? '') === 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                            <option value="PA" {{ ($supplier->state ?? '') === 'PA' ? 'selected' : '' }}>Pará</option>
                                            <option value="PB" {{ ($supplier->state ?? '') === 'PB' ? 'selected' : '' }}>Paraíba</option>
                                            <option value="PR" {{ ($supplier->state ?? '') === 'PR' ? 'selected' : '' }}>Paraná</option>
                                            <option value="PE" {{ ($supplier->state ?? '') === 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                            <option value="PI" {{ ($supplier->state ?? '') === 'PI' ? 'selected' : '' }}>Piauí</option>
                                            <option value="RJ" {{ ($supplier->state ?? '') === 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                            <option value="RN" {{ ($supplier->state ?? '') === 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                            <option value="RS" {{ ($supplier->state ?? '') === 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                            <option value="RO" {{ ($supplier->state ?? '') === 'RO' ? 'selected' : '' }}>Rondônia</option>
                                            <option value="RR" {{ ($supplier->state ?? '') === 'RR' ? 'selected' : '' }}>Roraima</option>
                                            <option value="SC" {{ ($supplier->state ?? '') === 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                            <option value="SP" {{ ($supplier->state ?? '') === 'SP' ? 'selected' : '' }}>São Paulo</option>
                                            <option value="SE" {{ ($supplier->state ?? '') === 'SE' ? 'selected' : '' }}>Sergipe</option>
                                            <option value="TO" {{ ($supplier->state ?? '') === 'TO' ? 'selected' : '' }}>Tocantins</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Inscrição Estadual</label>
                                        <input type="text" class="form-control form-control-solid" name="stateRegistration" value="{{ $supplier->stateRegistration ?? '' }}" placeholder="Inscrição Estadual" />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <div class="form-check form-check-custom form-check-solid mt-8">
                                            <input class="form-check-input" type="checkbox" name="lgpdTerm" value="1" id="lgpdTerm" {{ ($supplier->lgpdTerm ?? false) ? 'checked' : '' }} />
                                            <label class="form-check-label fw-semibold" for="lgpdTerm">
                                                Aceito os termos da LGPD
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="separator my-7"></div>

                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-light me-3">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" id="save-profile">
                                        <span class="indicator-label">Salvar Alterações</span>
                                        <span class="indicator-progress">Salvando... 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card card-flush mt-5">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold">Configurações Avançadas</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-9">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-5 bg-light-secondary rounded border border-secondary">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-notification-bing text-secondary fs-2 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                            <div>
                                                <div class="fw-bold text-dark">Notificações por Email</div>
                                                <div class="text-muted fs-7">Receber notificações importantes</div>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="" id="email-notifications" checked />
                                            <label class="form-check-label" for="email-notifications"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-5 bg-light-secondary rounded border border-secondary">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-shield-tick text-secondary fs-2 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div>
                                                <div class="fw-bold text-dark">Autenticação em Duas Etapas</div>
                                                <div class="text-muted fs-7">Maior segurança para sua conta</div>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="" id="two-factor" />
                                            <label class="form-check-label" for="two-factor"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-9 mt-5">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-5 bg-light-secondary rounded border border-secondary">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-graph-up text-secondary fs-2 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                            </i>
                                            <div>
                                                <div class="fw-bold text-dark">Relatórios Automáticos</div>
                                                <div class="text-muted fs-7">Relatórios mensais por email</div>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="" id="auto-reports" checked />
                                            <label class="form-check-label" for="auto-reports"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-5 bg-light-secondary rounded border border-secondary">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-rocket text-secondary fs-2 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div>
                                                <div class="fw-bold text-dark">Modo Avançado</div>
                                                <div class="text-muted fs-7">Recursos experimentais</div>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="" id="advanced-mode" />
                                            <label class="form-check-label" for="advanced-mode"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 