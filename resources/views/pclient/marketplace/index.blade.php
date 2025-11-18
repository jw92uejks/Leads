@extends('layouts.app')
@section('title', 'Mercado de Leads')
@section('marketplace', 'active')

@section('headlocal')
    @includeIf('pclient.marketplace.jscss.css')
    @includeIf('pclient.marketplace.jscss.headjs')
@endsection

@section('jslocal') @includeIf('pclient.marketplace.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Mercado de Leads</h1>
                <span class="text-muted">Explore fornecedores ativos premium com busca horizontal avançada</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="app-container container-fluid">

            <form action="#" id="kt_marketplace_search_form">
                <div class="card mb-7">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center flex-grow-1 me-3">
                                <div class="position-relative flex-grow-1 me-3">
                                    <i class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="text" class="form-control form-control-solid ps-10" name="search" value="" placeholder="Buscar fornecedores ativos..." id="search-input" />
                                </div>
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-icon btn-color-pink btn-active-color-primary p-2" id="kt_horizontal_search_advanced_link" data-bs-toggle="collapse" data-bs-target="#kt_advanced_search_form" aria-expanded="false" aria-controls="kt_advanced_search_form" title="Busca Avançada">
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
                        <div class="collapse" id="kt_advanced_search_form" data-bs-parent="#kt_marketplace_search_form">
                            <div class="separator separator-dashed mt-9 mb-6"></div>
                            <div class="row g-8 mb-6">
                                <div class="col-xxl-6">
                                    <label class="fs-6 form-label fw-bold text-dark">Segmentos</label>
                                    <input type="text" class="form-control bg-white" name="tags" value="" placeholder="Ex: automotivo, e-commerce, saúde" />
                                </div>
                                <div class="col-xxl-6">
                                    <label class="fs-6 form-label fw-bold text-dark">Temperatura do Lead</label>
                                    <select class="form-select bg-white" data-control="select2" data-placeholder="Selecione" data-hide-search="true" name="temperature">
                                        <option value=""></option>
                                        <option value="quente">Quente - Pronto para comprar</option>
                                        <option value="morno">Morno - Interesse moderado</option>
                                        <option value="frio">Frio - Prospecção inicial</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-8">
                                <div class="col-xxl-3">
                                    <label class="fs-6 form-label fw-bold text-dark">Preço Mín. (R$)</label>
                                    <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="100" data-kt-dialer-max="50000" data-kt-dialer-step="100" data-kt-dialer-prefix="R$ " data-kt-dialer-decimals="2">
                                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                            <i class="ki-duotone ki-minus-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                        <input type="text" class="form-control bg-white border-0 ps-12" data-kt-dialer-control="input" placeholder="Valor mínimo" name="min_price" readonly="readonly" value="R$ 500" />
                                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                            <i class="ki-duotone ki-plus-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-xxl-3">
                                    <label class="fs-6 form-label fw-bold text-dark">Preço Máx. (R$)</label>
                                    <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="100" data-kt-dialer-max="50000" data-kt-dialer-step="100" data-kt-dialer-prefix="R$ " data-kt-dialer-decimals="2">
                                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                            <i class="ki-duotone ki-minus-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                        <input type="text" class="form-control bg-white border-0 ps-12" data-kt-dialer-control="input" placeholder="Valor máximo" name="max_price" readonly="readonly" value="R$ 5000" />
                                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                            <i class="ki-duotone ki-plus-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-xxl-3">
                                    <label class="fs-6 form-label fw-bold text-dark">Operadoras de Saúde</label>
                                    <select class="form-select bg-white" data-control="select2" data-placeholder="Selecione operadoras" data-allow-clear="true" name="health_operators" multiple>
                                        <option value="ameplan">Ameplan</option>
                                        <option value="amil">Amil</option>
                                        <option value="apdm">Associação Paulista para o Desenvolvimento da Medicina</option>
                                        <option value="assim">Assim Saúde</option>
                                        <option value="biovida">Biovida Saúde</option>
                                        <option value="bradesco">Bradesco Saúde</option>
                                        <option value="cassi">Cassi</option>
                                        <option value="clinipam">Clinipam</option>
                                        <option value="fachini">Fachini Saúde</option>
                                        <option value="golden_cross">Golden Cross</option>
                                        <option value="hapvida">Hapvida</option>
                                        <option value="humana">Humana Saúde</option>
                                        <option value="intermedica">Intermédica</option>
                                        <option value="medsenior">MedSênior</option>
                                        <option value="medial">Medial Saúde</option>
                                        <option value="notredame">NotreDame Intermédica</option>
                                        <option value="plamed">Plamed</option>
                                        <option value="porto">Porto Saúde</option>
                                        <option value="prevent">Prevent Senior</option>
                                        <option value="santa_helena">Santa Helena Saúde</option>
                                        <option value="sao_francisco">São Francisco Saúde</option>
                                        <option value="petrobras">Saúde Petrobras</option>
                                        <option value="sompo">Sompo Saúde</option>
                                        <option value="sulamerica">SulAmérica Saúde</option>
                                        <option value="unimed">Unimed</option>
                                        <option value="vitolife">Vitolife Saúde</option>
                                    </select>
                                </div>
                                <div class="col-xxl-3">
                                    <label class="fs-6 form-label fw-bold text-dark">Região por DDD</label>
                                    <select class="form-select bg-white" data-control="select2" data-placeholder="Selecione DDDs" data-allow-clear="true" name="ddds" multiple>
                                        <option value="11">11 - São Paulo</option>
                                        <option value="12">12 - São José dos Campos</option>
                                        <option value="13">13 - Santos</option>
                                        <option value="14">14 - Bauru</option>
                                        <option value="15">15 - Sorocaba</option>
                                        <option value="16">16 - Ribeirão Preto</option>
                                        <option value="17">17 - São José do Rio Preto</option>
                                        <option value="18">18 - Presidente Prudente</option>
                                        <option value="19">19 - Campinas</option>
                                        <option value="21">21 - Rio de Janeiro</option>
                                        <option value="22">22 - Campos dos Goytacazes</option>
                                        <option value="24">24 - Volta Redonda</option>
                                        <option value="27">27 - Vitória</option>
                                        <option value="28">28 - Cachoeiro de Itapemirim</option>
                                        <option value="31">31 - Belo Horizonte</option>
                                        <option value="32">32 - Juiz de Fora</option>
                                        <option value="33">33 - Governador Valadares</option>
                                        <option value="34">34 - Uberlândia</option>
                                        <option value="35">35 - Poços de Caldas</option>
                                        <option value="37">37 - Divinópolis</option>
                                        <option value="38">38 - Montes Claros</option>
                                        <option value="41">41 - Curitiba</option>
                                        <option value="42">42 - Ponta Grossa</option>
                                        <option value="43">43 - Londrina</option>
                                        <option value="44">44 - Maringá</option>
                                        <option value="45">45 - Foz do Iguaçu</option>
                                        <option value="46">46 - Francisco Beltrão</option>
                                        <option value="47">47 - Joinville</option>
                                        <option value="48">48 - Florianópolis</option>
                                        <option value="49">49 - Chapecó</option>
                                        <option value="51">51 - Porto Alegre</option>
                                        <option value="53">53 - Pelotas</option>
                                        <option value="54">54 - Caxias do Sul</option>
                                        <option value="55">55 - Santa Maria</option>
                                        <option value="61">61 - Brasília</option>
                                        <option value="62">62 - Goiânia</option>
                                        <option value="64">64 - Rio Verde</option>
                                        <option value="65">65 - Cuiabá</option>
                                        <option value="66">66 - Rondonópolis</option>
                                        <option value="67">67 - Campo Grande</option>
                                        <option value="68">68 - Rio Branco</option>
                                        <option value="69">69 - Porto Velho</option>
                                        <option value="71">71 - Salvador</option>
                                        <option value="73">73 - Ilhéus</option>
                                        <option value="74">74 - Juazeiro</option>
                                        <option value="75">75 - Feira de Santana</option>
                                        <option value="77">77 - Vitória da Conquista</option>
                                        <option value="79">79 - Aracaju</option>
                                        <option value="81">81 - Recife</option>
                                        <option value="87">87 - Petrolina</option>
                                        <option value="82">82 - Maceió</option>
                                        <option value="83">83 - João Pessoa</option>
                                        <option value="84">84 - Natal</option>
                                        <option value="85">85 - Fortaleza</option>
                                        <option value="88">88 - Juazeiro do Norte</option>
                                        <option value="86">86 - Teresina</option>
                                        <option value="89">89 - Picos</option>
                                        <option value="98">98 - São Luís</option>
                                        <option value="99">99 - Imperatriz</option>
                                        <option value="91">91 - Belém</option>
                                        <option value="93">93 - Santarém</option>
                                        <option value="94">94 - Marabá</option>
                                        <option value="95">95 - Boa Vista</option>
                                        <option value="96">96 - Macapá</option>
                                        <option value="92">92 - Manaus</option>
                                        <option value="97">97 - Coari</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="d-flex flex-wrap flex-stack pb-7">
                <div class="d-flex flex-wrap align-items-center my-1">
                    <h3 class="fw-bold me-5 my-1">
                        @if ($suppliers->count() > 0)
                            <span id="total-packages">{{$suppliers->count()}}</span> Fornecedores Encontrados
                        @else
                            Nenhum fornecedor encontrados
                        @endif
                        <span class="text-gray-400 fs-6">ordenados por ↓ <span id="current-sort">Relevância</span></span>
                    </h3>
                </div>
                <div class="d-flex flex-wrap align-items-center my-1">
                    <span class="d-inline-flex align-items-center justify-content-center me-1" style="width: 30px; height: 30px; background-color: #f1416c; border-radius: 4px;">
                        <i class="ki-duotone ki-element-plus fs-2 text-white">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </span>
                    <div class="d-flex my-0">
                        <select name="sort" data-control="select2" data-hide-search="true" data-placeholder="Ordenar" class="form-select form-select-sm border-body w-150px" id="sort-select">
                            <option value="relevance">Relevantes</option>
                            <option value="price_low">Menor Preço</option>
                            <option value="price_high">Maior Preço</option>
                            <option value="rating">Avaliados</option>
                            <option value="recent">Recentes</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div id="kt_marketplace_card_view" class="tab-pane fade show active">
                    <div class="row g-6 g-xl-9 row-cols-1 row-cols-md-2 row-cols-xl-4" id="cards-container">
                        @foreach ($suppliers as $supplier)
                            <div class="package-card">
                                <a href="{{ route('marketplace.supplier.leads', $supplier->id) }}" class="card marketplace-package-card text-decoration-none h-100 hover-elevate-up">
                                    <div class="card-body d-flex flex-center flex-column pt-12 px-6 pb-9 h-100">
                                        <div class="symbol symbol-100px symbol-circle mb-5">
                                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="{{ $supplier->name }}" class="w-100 h-100 rounded-circle object-fit-cover">
                                        </div>
                                        <div class="rating mb-3">
                                            @for ($i = 0; $i < 5; $i++)
                                                <div class="rating-label me-2 {{ $i < $supplier->rating ? 'checked' : '' }}">
                                                    <i class="ki-duotone ki-star fs-5"></i>
                                                </div>
                                            @endfor
                                        </div>
                                        <div class="fs-4 text-gray-800 text-hover-primary fw-bold mb-2 text-center">{{ $supplier->name }}</div>
                                        <div class="fw-semibold text-gray-400 mb-3">Conectamos você a quem quer comprar</div>
                                        <div class="fs-6 fw-bold text-gray-700 mb-6">R$ {{ number_format($supplier->leads_min_currentprice, 2, ',', '.') }} a R$ {{ number_format($supplier->leads_max_currentprice, 2, ',', '.') }}</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
