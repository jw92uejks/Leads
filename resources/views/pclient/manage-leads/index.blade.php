@extends('layouts.app')
@section('title', 'Gerenciar Leads')
@section('manage-leads', 'active')

@section('headlocal') @includeIf('pclient.manage-leads.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.manage-leads.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Gerenciar Leads</h1>
                <span class="text-muted">Adicione leads manualmente ou faça upload em massa via Excel</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="app-container container-fluid">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-8">
                    <div class="card card-flush">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold">Adicionar Lead Manualmente</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="lead-form" action="{{ route('manage-leads.store') }}" method="POST" x-data="{ pricingType: '' }">
                                @csrf
                                @php
                                    $source = \App\Enums\Lead\LeadSource::SYSTEM;
                                @endphp
                                <input type="hidden" name="source" value="{{ $source }}">
                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Nome</label>
                                        <input type="text" class="form-control form-control-solid" name="name" placeholder="Nome completo do lead" required />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Nome Corporativo</label>
                                        <input type="text" class="form-control form-control-solid" name="corporateName" placeholder="Nome da empresa" />
                                    </div>
                                </div>

                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Telefone</label>
                                        <input type="text" class="form-control form-control-solid" name="phone" placeholder="(11) 99999-9999" required />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Email</label>
                                        <input type="email" class="form-control form-control-solid" name="email" placeholder="email@exemplo.com" required />
                                    </div>
                                </div>

                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Tipo de Lead</label>
                                        <select class="form-select form-select-solid" name="type" required>
                                            <option value="">Selecione o tipo</option>
                                            @php
                                                $types = collect(\App\Enums\Lead\LeadType::cases())->filter(function($type) {
                                                    return $type !== \App\Enums\Lead\LeadType::MISTA;
                                                });
                                            @endphp
                                            @foreach($types as $type)
                                                <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Cidade</label>
                                        <input type="text" class="form-control form-control-solid" name="city" placeholder="Cidade" required />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Estado</label>
                                        <select class="form-select form-select-solid" name="state" required>
                                            <option value="">Selecione o estado</option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Temperatura</label>
                                        <select class="form-select form-select-solid" name="temperature" required>
                                            <option value="">Selecione a temperatura</option>
                                            @php
                                                $temperatures = \App\Enums\Lead\LeadTemperature::cases();
                                            @endphp
                                            @foreach($temperatures as $temperature)
                                                <option value="{{ $temperature->value }}">{{ $temperature->label() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Tracking</label>
                                        <input type="text" class="form-control form-control-solid" name="traking" placeholder="Código de rastreamento" />
                                    </div>
                                </div>

                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Tipo de Preço</label>
                                        <select class="form-select form-select-solid" name="pricingType" required x-model="pricingType">
                                            <option value="">Selecione o tipo</option>
                                            @php
                                                $pricing = \App\Enums\Lead\LeadPricingType::cases();
                                            @endphp
                                            @foreach($pricing as $type)
                                                <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row" x-show="!['fixed', 'automatic'].includes(pricingType)">
                                        <label class="required fs-6 fw-semibold mb-2">Preço Atual (R$)</label>
                                        <input type="number" step="0.01" class="form-control form-control-solid" name="currentPrice" placeholder="150.00" />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2" x-text="['fixed', 'automatic'].includes(pricingType) ? 'Preço (R$)' : 'Preço Inicial (R$)'">Preço Inicial (R$)</label>
                                        <input type="number" step="0.01" class="form-control form-control-solid" name="startPrice" placeholder="200.00" required/>
                                    </div>
                                </div>

                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Vidas</label>
                                        <input type="number" class="form-control form-control-solid" name="lifes" placeholder="3" />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">Código do Lead</label>
                                        <input type="text" class="form-control form-control-solid" name="leadCode" placeholder="LEAD-001" />
                                    </div>
                                </div>

                                <div class="row g-9 mb-7">
                                    <div class="col-md-6 fv-row">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" name="isAutomation" value="1" id="isAutomation" />
                                            <label class="form-check-label fw-semibold" for="isAutomation">
                                                É Automação
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" name="acceptContestation" value="1" id="acceptContestation" />
                                            <label class="form-check-label fw-semibold" for="acceptContestation">
                                                Aceita Contestação
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Descrição</label>
                                    <textarea class="form-control form-control-solid" name="description" rows="3" placeholder="Descrição adicional do lead"></textarea>
                                </div>

                                <div class="text-center">
                                    <button type="reset" class="btn btn-light me-3">Limpar</button>
                                    <button type="submit" class="btn btn-primary" id="submit-lead">
                                        <span class="indicator-label">Salvar Lead</span>
                                        <span class="indicator-progress">Salvando...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold">Upload em Massa</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-7">
                                <i class="ki-duotone ki-file-up fs-4x text-primary mb-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <h4 class="fw-bold">Importar via Excel</h4>
                                <p class="text-muted">Faça upload de múltiplos leads de uma só vez</p>
                            </div>

                            <div class="mb-7">
                                <a href="{{ route('manage-leads.template') }}" class="btn btn-light-success w-100">
                                    <i class="ki-duotone ki-file-down fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Baixar Modelo Excel
                                </a>
                                <div class="form-text text-center">Baixe o modelo para preencher corretamente</div>
                            </div>

                            <form id="upload-form" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-7">
                                    <label class="form-label fw-semibold">Arquivo Excel</label>
                                    <input type="file" class="form-control form-control-solid" name="excel_file" accept=".xlsx,.xls,.csv" required />
                                    <div class="form-text">Formatos aceitos: .xlsx, .xls, .csv</div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100" id="upload-btn">
                                    <span class="indicator-label">
                                        <i class="ki-duotone ki-cloud-upload fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Fazer Upload
                                    </span>
                                    <span class="indicator-progress">Processando...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </form>

                            <div class="separator my-7"></div>

                            <div class="mb-7">
                                <h5 class="fw-bold text-dark mb-3">Instruções</h5>
                                <ul class="list-unstyled">
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="ki-duotone ki-check-circle text-success fs-5 me-2 mt-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="text-muted fs-7">Baixe o modelo Excel primeiro</span>
                                    </li>
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="ki-duotone ki-check-circle text-success fs-5 me-2 mt-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="text-muted fs-7">Preencha todos os campos obrigatórios</span>
                                    </li>
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="ki-duotone ki-check-circle text-success fs-5 me-2 mt-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="text-muted fs-7">Máximo de 1000 leads por arquivo</span>
                                    </li>
                                    <li class="d-flex align-items-start">
                                        <i class="ki-duotone ki-check-circle text-success fs-5 me-2 mt-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="text-muted fs-7">Processamento pode levar alguns minutos</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
