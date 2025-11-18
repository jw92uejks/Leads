@extends('layouts.app')
@section('title', 'Leads Disponíveis')
@section('marketplace', 'active')

@section('headlocal')
    @includeIf('pclient.marketplace.jscss.css')
    @includeIf('pclient.marketplace.jscss.headjs')
@endsection

@section('jslocal') @includeIf('pclient.marketplace.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid" x-data="purchaseLeads">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Leads Disponíveis - {{ $supplier->name }}</h1>
                <span class="text-muted">Explore e adquira leads de alta qualidade deste fornecedor</span>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('marketplace.index') }}" class="btn btn-sm btn-light">
                    <i class="ki-duotone ki-arrow-left fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Voltar ao Marketplace
                </a>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="app-container container-fluid">
            <div class="card mb-7">
                <div class="card-body">
                    <form action="{{ route('marketplace.supplier.leads', $supplier->id) }}" method="GET" id="leads-filter-form">
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <div class="d-flex align-items-center flex-grow-1 me-3">
                                <div class="position-relative flex-grow-1 me-3">
                                    <i class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="text" class="form-control form-control-solid ps-10" name="search" placeholder="Buscar leads..." id="search-leads" value="{{ request('search') }}" />
                                </div>
                                <button type="submit" class="btn btn-primary" id="search-btn">Buscar</button>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-icon btn-color-pink btn-active-color-primary p-2" data-bs-toggle="collapse" href="#kt_leads_filters" title="Filtros">
                                    <i class="ki-duotone ki-setting-3 text-pink fs-2x p-0 m-0">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </button>
                            </div>
                        </div>

                        <div class="collapse" id="kt_leads_filters">
                            <div class="separator separator-dashed mt-3 mb-6"></div>
                            <div class="row g-6 mb-6">
                                <div class="col-md-3">
                                    <label class="fs-6 form-label fw-bold text-dark">Tipo de Lead</label>
                                    <select class="form-select bg-white" data-control="select2" data-placeholder="Todos os tipos" data-hide-search="true" name="lead_type">
                                        <option value="">Todos os tipos</option>
                                        <option value="1" {{ request('lead_type') == '1' ? 'selected' : '' }}>Pessoa Física</option>
                                        <option value="2" {{ request('lead_type') == '2' ? 'selected' : '' }}>Pessoa Jurídica</option>
                                        <option value="3" {{ request('lead_type') == '3' ? 'selected' : '' }}>Adesão</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="fs-6 form-label fw-bold text-dark">Região (DDD)</label>
                                    <select class="form-select bg-white" data-control="select2" data-placeholder="Todas as regiões" name="ddd">
                                        <option value="">Todas as regiões</option>
                                        <option value="11" {{ request('ddd') == '11' ? 'selected' : '' }}>11 - São Paulo</option>
                                        <option value="21" {{ request('ddd') == '21' ? 'selected' : '' }}>21 - Rio de Janeiro</option>
                                        <option value="31" {{ request('ddd') == '31' ? 'selected' : '' }}>31 - Belo Horizonte</option>
                                        <option value="41" {{ request('ddd') == '41' ? 'selected' : '' }}>41 - Curitiba</option>
                                        <option value="51" {{ request('ddd') == '51' ? 'selected' : '' }}>51 - Porto Alegre</option>
                                        <option value="61" {{ request('ddd') == '61' ? 'selected' : '' }}>61 - Brasília</option>
                                        <option value="71" {{ request('ddd') == '71' ? 'selected' : '' }}>71 - Salvador</option>
                                        <option value="81" {{ request('ddd') == '81' ? 'selected' : '' }}>81 - Recife</option>
                                        <option value="85" {{ request('ddd') == '85' ? 'selected' : '' }}>85 - Fortaleza</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="fs-6 form-label fw-bold text-dark">Operadora</label>
                                    <select class="form-select bg-white" data-control="select2" data-placeholder="Todas as operadoras" name="operadora">
                                        <option value="">Todas as operadoras</option>
                                        <option value="amil" {{ request('operadora') == 'amil' ? 'selected' : '' }}>Amil</option>
                                        <option value="unimed" {{ request('operadora') == 'unimed' ? 'selected' : '' }}>Unimed</option>
                                        <option value="bradesco" {{ request('operadora') == 'bradesco' ? 'selected' : '' }}>Bradesco Saúde</option>
                                        <option value="sulamerica" {{ request('operadora') == 'sulamerica' ? 'selected' : '' }}>SulAmérica</option>
                                        <option value="porto" {{ request('operadora') == 'porto' ? 'selected' : '' }}>Porto Seguro</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="fs-6 form-label fw-bold text-dark">Faixa de Preço</label>
                                    <select class="form-select bg-white" data-control="select2" data-placeholder="Todos os preços" data-hide-search="true" name="price_range">
                                        <option value="">Todos os preços</option>
                                        <option value="0-200" {{ request('price_range') == '0-200' ? 'selected' : '' }}>R$ 0 - R$ 200</option>
                                        <option value="200-500" {{ request('price_range') == '200-500' ? 'selected' : '' }}>R$ 200 - R$ 500</option>
                                        <option value="500-1000" {{ request('price_range') == '500-1000' ? 'selected' : '' }}>R$ 500 - R$ 1.000</option>
                                        <option value="1000+" {{ request('price_range') == '1000+' ? 'selected' : '' }}>Acima de R$ 1.000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-6">
                                <div class="col-md-4">
                                    <label class="fs-6 form-label fw-bold text-dark">Data de Criação</label>
                                    <select class="form-select bg-white" data-control="select2" data-placeholder="Qualquer data" data-hide-search="true" name="date_range">
                                        <option value="">Qualquer data</option>
                                        <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Hoje</option>
                                        <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>Última semana</option>
                                        <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>Último mês</option>
                                        <option value="3months" {{ request('date_range') == '3months' ? 'selected' : '' }}>Últimos 3 meses</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="fs-6 form-label fw-bold text-dark">Ordenar por</label>
                                    <select class="form-select bg-white" data-control="select2" data-placeholder="Mais recente" data-hide-search="true" name="sort">
                                        <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Mais recente</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Mais antigo</option>
                                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Menor preço</option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Maior preço</option>
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <a href="{{ route('marketplace.supplier.leads', $supplier->id) }}" class="btn btn-light me-2">Limpar Filtros</a>
                                    <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex flex-wrap flex-stack pb-7">
                <div class="d-flex flex-wrap align-items-center my-1">
                    <h3 class="fw-bold me-5 my-1">
                        {{ $leads->total() }} Leads Encontrados
                        <span class="text-gray-400 fs-6">página {{ $leads->currentPage() }} de {{ $leads->lastPage() }}</span>
                    </h3>
                </div>
                <div class="d-flex flex-wrap my-1">
                    <button type="button" class="btn btn-light-primary me-2" x-on:click="clearSelection()" :disabled="selectedLeads.length === 0">
                        <i class="ki-duotone ki-trash fs-2"></i>
                        Limpar Seleção
                    </button>
                    <button type="button" class="btn btn-primary" x-on:click="handlePurchaseLeads()" :disabled="selectedLeads.length === 0" style="background-color: #f1416c; border-color: #f1416c;">
                        <i class="ki-duotone ki-check fs-2"></i>
                        Comprar Selecionados (<span x-text="selectedLeads.length"></span>)
                    </button>
                </div>
            </div>

            <div class="row g-6" id="leads_grid_container">
                @forelse ($leads as $lead)
                <div class="col-md-4">
                    <div class="card h-100 lead-item-card cursor-pointer"
                         data-lead-id="{{ $lead->id }}"
                         data-lead-price="{{ $lead->currentPrice }}"
                         x-on:click="toggleLeadSelection({{ $lead->id }}, {{ $lead->currentPrice }})"
                         :class="selectedLeads.includes({{ $lead->id }}) ? 'border-primary shadow-sm' : ''">
                        <div class="card-body p-0">
                            <div class="d-flex h-100">
                                <div class="lead-thumb-section d-flex align-items-center justify-content-center position-relative" style="width: 25%;">
                                    <div class="position-absolute top-0 start-0 m-2" x-show="selectedLeads.includes({{ $lead->id }})">
                                        <div class="badge badge-circle badge-primary">
                                            <i class="ki-duotone ki-check fs-6 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="lead-thumb-image" style="width: 70%; height: 70%;">
                                        @if($lead->healthOperator && $lead->healthOperator->logo)
                                            <img src="{{ asset($lead->healthOperator->logo) }}" alt="{{ $lead->healthOperator->name }}" class="w-100 h-100 object-fit-contain">
                                        @else
                                            <img src="{{ asset('assets/images/suppliers/mixed_supplier.png') }}" alt="Operadora" class="w-100 h-100 object-fit-contain">
                                        @endif
                                    </div>
                                </div>
                                <div class="lead-info-section flex-grow-1 p-4" style="width: 75%;">
                                    <div class="mb-3">
                                        <span class="badge badge-light-{{ $lead->type === \App\Enums\Lead\LeadType::PF ? 'primary' : ($lead->type === \App\Enums\Lead\LeadType::PJ ? 'info' : 'warning') }}"
                                              style="{{ $lead->type === \App\Enums\Lead\LeadType::PF ? 'background-color: rgba(116, 103, 239, 0.1); color: #7467ef;' : '' }}">
                                            {{ $lead->type->label() }}
                                        </span>
                                    </div>

                                    <div class="lead-info-item mb-2">
                                        <i class="ki-duotone ki-geolocation text-gray-500 me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="text-gray-700">
                                            <strong>Região</strong>
                                            @if($lead->phone)
                                                DDD ({{ substr(preg_replace('/[^0-9]/', '', $lead->phone), 0, 2) }})
                                            @else
                                                {{ $lead->city ?? 'N/A' }}
                                            @endif
                                        </span>
                                    </div>

                                    <div class="lead-info-item mb-2">
                                        <i class="ki-duotone ki-time text-gray-500 me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="text-gray-700">
                                            <strong>Criado em</strong>
                                            {{ $lead->created_at ? $lead->created_at->format('d/m/y H:i') : 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="lead-info-item mb-3">
                                        <i class="ki-duotone ki-check-square text-gray-500 me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="text-gray-700">
                                            <strong>Operadora</strong>
                                            {{ $lead->healthOperator ? $lead->healthOperator->name : ($lead->source ?? 'N/A') }}
                                        </span>
                                    </div>

                                    <div class="lead-price">
                                        <span class="fw-bold fs-5" style="color: #f1416c;">R$ {{ number_format($lead->currentPrice, 2, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-10">
                        <div class="card">
                            <div class="card-body">
                                <div class="py-10">
                                    <i class="ki-duotone ki-folder fs-5x text-gray-300 mb-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <h3 class="text-gray-700 fw-bold fs-2 mb-3">Nenhum lead encontrado</h3>
                                    <p class="text-gray-500 mb-5">Este fornecedor não possui leads disponíveis no momento.</p>
                                    <a href="{{ route('marketplace.index') }}" class="btn btn-primary">
                                        <i class="ki-duotone ki-arrow-left fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Voltar ao Marketplace
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            @if($leads->hasPages())
            <div class="d-flex justify-content-center mt-8">
                {{ $leads->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection