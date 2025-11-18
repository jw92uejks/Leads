@extends('layouts.app')
@section('title', 'Carrinho de Compras')
@section('cart', 'active')

@section('headlocal') @includeIf('pclient.cart.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.cart.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Carrinho de Compras</h1>
                <span class="text-muted">Finalize sua compra de leads dos fornecedores</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form action="#" method="POST" id="kt_cart_form" class="form">
                @csrf

                <div class="row g-5 g-xl-8 mb-xl-8">
                    <div class="col-xl-8">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Leads Selecionados</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive" style="height: 900px; overflow-y: auto;">
                                    <table class="table align-middle table-row-dashed fs-6 gy-3 mb-0">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-100px">Tipo</th>
                                                <th class="text-center min-w-100px">Região</th>
                                                <th class="text-center min-w-120px">Criação</th>
                                                <th class="text-center min-w-120px">Operadora</th>
                                                <th class="text-end min-w-80px">Preço</th>
                                                <th class="text-center min-w-80px">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600" id="cart-items-tbody">
                                            @if($cart->count() > 0)
                                                @foreach ($cart as $item)
                                                    <tr>
                                                        <td>
                                                            <span class="badge badge-light-{{ $item->lead->type === \App\Enums\Lead\LeadType::PF ? 'primary' : ($item->lead->type === \App\Enums\Lead\LeadType::PJ ? 'info' : 'warning') }}"
                                                                  style="{{ $item->lead->type === \App\Enums\Lead\LeadType::PF ? 'background-color: rgba(116, 103, 239, 0.1); color: #7467ef;' : '' }}">
                                                                {{ $item->lead->type->label() }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="text-gray-600">DDD ({{ $item->lead->city ?? 'N/A' }})</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="text-gray-600">{{ $item->lead->created_at ? $item->lead->created_at->format('d/m/y H:i') : 'N/A' }}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="text-gray-600">{{ $item->lead->source ?? 'N/A' }}</span>
                                                        </td>
                                                        <td class="text-end fw-bold">R$ {{ number_format($item->lead->currentPrice, 2, ',', '.') }}</td>
                                                        <td class="text-center">
                                                            <div class="d-flex justify-content-center">
                                                                <button type="button" class="btn btn-icon btn-sm btn-light-danger">
                                                                    <i class="ki-duotone ki-trash fs-5">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                        <span class="path5"></span>
                                                                    </i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center py-10">
                                                        <div class="text-muted">
                                                            <i class="ki-duotone ki-basket fs-3x mb-3">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                                <span class="path4"></span>
                                                            </i>
                                                            <h5 class="fw-bold text-gray-600 mb-2">Seu carrinho está vazio</h5>
                                                            <p class="text-muted">Adicione leads do marketplace para começar</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center align-items-center mb-5 mt-5">
                                    <div class="fw-bold fs-4">Total de Leads: <span id="cart-item-count">{{ $cart->count() }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card card-flush py-4 sticky-top" style="top: 2rem;">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Resumo do Pedido</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                        <tbody class="fw-semibold text-gray-600">
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-calculator fs-2 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>Subtotal
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end" data-subtotal>R$ 0,00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-percentage fs-2 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>Taxa de Processamento (2%)
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end" data-tax>R$ 0,00</td>
                                            </tr>
                                            <tr>
                                                <td class="border-0"></td>
                                                <td class="border-0 pt-5">
                                                    <div class="d-flex flex-stack">
                                                        <span class="fw-bold fs-6 text-gray-800">Total</span>
                                                        <span class="fs-2 fw-bold text-gray-900" id="cart-total">R$ 0,00</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="separator separator-dashed mt-0 mb-10"></div>

                                <div class="mb-8">
                                    <h4 class="fw-bold mb-3">Cupom de Desconto</h4>
                                    <div class="d-flex gap-2">
                                        <input type="text" class="form-control" id="coupon_code" placeholder="Digite seu cupom" />
                                        <button type="button" class="btn btn-secondary" id="apply_coupon">
                                            Aplicar
                                        </button>
                                    </div>
                                </div>

                                <div class="separator separator-dashed my-6"></div>

                                <div class="d-flex flex-column gap-3">
                                    <a href="{{ route('marketplace.index') }}" class="btn btn-light">
                                        <i class="ki-duotone ki-arrow-left fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Continuar Comprando
                                    </a>
                                    <button type="submit" id="kt_cart_submit" class="btn btn-primary">
                                        <span class="indicator-label">Finalizar Compra</span>
                                        <span class="indicator-progress">Processando...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

@endsection
