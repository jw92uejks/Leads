@extends('layouts.app')
@section('title', 'API de Leads')
@section('api-leads', 'active')

@section('headlocal') @includeIf('pclient.api-leads.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.api-leads.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">API de Leads</h1>
                <span class="text-muted">Configure e gerencie suas integrações via API</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="app-container container-fluid">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-6">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Configuração da API</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Chaves de acesso e configurações</span>
                            </h3>
                        </div>
                        <div class="card-body pt-2">
                            <div class="mb-7">
                                <label class="form-label fw-semibold">API Key</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-solid" id="api-key" value="sk_live_51M..." readonly />
                                    <button class="btn btn-icon btn-secondary" type="button" id="copy-api-key">
                                        <i class="ki-duotone ki-copy fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                </div>
                                <div class="form-text">Esta chave será usada para autenticar suas requisições</div>
                            </div>

                            <div class="mb-7">
                                <label class="form-label fw-semibold">Webhook URL</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-solid" value="https://api.ondeal.com.br/webhook/leads" readonly />
                                    <button class="btn btn-icon btn-secondary" type="button" id="copy-webhook">
                                        <i class="ki-duotone ki-copy fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                </div>
                                <div class="form-text">Configure este endpoint em seu sistema para enviar leads</div>
                            </div>

                            <div class="mb-7">
                                <label class="form-label fw-semibold">Status da Integração</label>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-light-success fs-7 fw-bold">Ativa</span>
                                    <div class="form-check form-switch form-check-custom form-check-solid ms-auto">
                                        <input class="form-check-input" type="checkbox" value="" id="toggle-integration" checked />
                                        <label class="form-check-label" for="toggle-integration"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" id="regenerate-key">
                                    <i class="ki-duotone ki-arrows-loop fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Regenerar Chave
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Documentação da API</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Endpoints e exemplos de uso</span>
                            </h3>
                        </div>
                        <div class="card-body pt-2">
                            <div class="mb-7">
                                <h5 class="fw-bold text-dark">Endpoint Base</h5>
                                <div class="bg-light-primary p-4 rounded">
                                    <code class="text-primary">POST https://api.ondeal.com.br/v1/leads</code>
                                </div>
                            </div>

                            <div class="mb-7">
                                <h5 class="fw-bold text-dark">Headers Obrigatórios</h5>
                                <div class="bg-light-dark p-4 rounded">
                                    <code class="text-dark">
                                        Content-Type: application/json<br/>
                                        Authorization: Bearer YOUR_API_KEY
                                    </code>
                                </div>
                            </div>

                            <div class="mb-7">
                                <h5 class="fw-bold text-dark">Exemplo de Payload</h5>
                                <div class="bg-light-info p-4 rounded">
                                    <code class="text-info" style="font-size: 12px;">
{<br/>
&nbsp;&nbsp;"name": "João Silva",<br/>
&nbsp;&nbsp;"email": "joao@email.com",<br/>
&nbsp;&nbsp;"phone": "(11) 99999-9999",<br/>
&nbsp;&nbsp;"leadType": "Empréstimo",<br/>
&nbsp;&nbsp;"city": "São Paulo",<br/>
&nbsp;&nbsp;"state": "SP",<br/>
&nbsp;&nbsp;"temperature": "hot",<br/>
&nbsp;&nbsp;"currentPrice": 150.00<br/>
}
                                    </code>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="#" class="btn btn-light-primary">
                                    <i class="ki-duotone ki-document fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Documentação Completa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5 g-xl-8 mt-5">
                <div class="col-xl-12">
                    <div class="card card-flush">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Estatísticas da API</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Últimos 30 dias</span>
                            </h3>
                        </div>
                        <div class="card-body pt-2">
                            <div class="row g-0">
                                <div class="col border-0 m-0">
                                    <div class="fw-semibold fs-6 text-gray-400">Total de Requisições</div>
                                    <div class="d-flex align-items-center my-2">
                                        <div class="symbol symbol-50px me-5">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="ki-duotone ki-arrows-loop text-primary fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fs-1 fw-semibold">1,247</div>
                                            <div class="fs-7 fw-semibold text-muted">+12% do mês passado</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col border-0 m-0">
                                    <div class="fw-semibold fs-6 text-gray-400">Leads Criados</div>
                                    <div class="d-flex align-items-center my-2">
                                        <div class="symbol symbol-50px me-5">
                                            <span class="symbol-label bg-light-success">
                                                <i class="ki-duotone ki-arrow-up text-success fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fs-1 fw-semibold">1,156</div>
                                            <div class="fs-7 fw-semibold text-muted">+8% do mês passado</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col border-0 m-0">
                                    <div class="fw-semibold fs-6 text-gray-400">Erros</div>
                                    <div class="d-flex align-items-center my-2">
                                        <div class="symbol symbol-50px me-5">
                                            <span class="symbol-label bg-light-danger">
                                                <i class="ki-duotone ki-cross-circle text-danger fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fs-1 fw-semibold">91</div>
                                            <div class="fs-7 fw-semibold text-muted">-3% do mês passado</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col border-0 m-0">
                                    <div class="fw-semibold fs-6 text-gray-400">Taxa de Sucesso</div>
                                    <div class="d-flex align-items-center my-2">
                                        <div class="symbol symbol-50px me-5">
                                            <span class="symbol-label bg-light-warning">
                                                <i class="ki-duotone ki-percentage text-warning fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fs-1 fw-semibold">92.7%</div>
                                            <div class="fs-7 fw-semibold text-muted">+1.2% do mês passado</div>
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