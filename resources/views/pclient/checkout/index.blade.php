@extends('layouts.app')
@section('title', 'Checkout')
@section('checkout', 'active')

@section('headlocal') @includeIf('pclient.checkout.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.checkout.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Checkout</h1>
                <span class="text-muted">Finalize sua compra de leads dos fornecedores</span>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('cart.index') }}" class="btn btn-light-primary" style="font-size: 1.1rem;">
                    <i class="ki-duotone ki-message-edit fs-2 me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    Alterar Pedido
                </a>
                <button type="button" id="finalizarCompra" class="btn btn-pink text-white" style="font-size: 1.1rem;">
                    Finalizar Compra
                    <i class="ki-duotone ki-exit-right-corner fs-2 text-white ms-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="col-lg-4">
                    <div class="card card-flush py-4 flex-row-fluid" style="background: #FFEEF4; border: 2px solid white;">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Destinatário do Lead</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-profile-circle fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>Usuário
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                        <div class="symbol-label">
                                                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Rafael Barros" class="w-100" />
                                                        </div>
                                                    </div>
                                                    <span class="text-gray-600">{{ auth()->user()->name }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-sms fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>Email
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ auth()->user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-phone fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>Telefone
                                                </div>
                                            </td>
                                            {{-- //[ ] Implement Phone in User --}}
                                            <td class="fw-bold text-end">{{ auth()->user()->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-flush py-4 flex-row-fluid">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Detalhes da Compra</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-calendar fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>Data da Compra
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">03/07/2025</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-credit-cart fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>Método de Pagamento
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">Créditos da Conta</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-wallet fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                    </i>Uso de Créditos
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">-100</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-flush py-4 flex-row-fluid">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Resumo da Transação</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-package fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>Total de Leads
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $cart->count() }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-graph-up fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                        <span class="path6"></span>
                                                    </i>Fornecedores Únicos
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">--</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-dollar fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>Valor Total
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end text-pink fs-2">R$ {{ number_format($cart->sum(fn($item) => $item->lead->currentPrice ?? 0), 2, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-flush py-4 flex-row-fluid leads-selecionados">
                <div class="card-header">
                    <div class="card-title">
                        <h2>Leads Selecionados</h2>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-3 mb-0">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-200px">Lead</th>
                                    <th class="text-center min-w-120px">Fornecedor</th>
                                    <th class="text-center min-w-100px">Avaliação</th>
                                    <th class="text-end min-w-80px">Preço</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($cart as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-35px me-3">
                                                    <div class="symbol-label" style="background-color: rgba(231, 29, 115, 0.1);">
                                                        <i class="ki-duotone ki-user fs-3" style="color: #e71d73;">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-gray-800 fs-6 mb-1">{{$item->lead->name}}</div>
                                                    <div class="text-muted fs-7">--</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-gray-600">{{ $item->lead->supplier->name }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <div class="rating">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <div class="rating-label {{ $i < $item->lead->supplier->rating ? 'checked' : '' }}">
                                                            <i class="ki-duotone ki-star fs-7"></i>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end fw-bold">R$ {{ number_format($item->lead->currentPrice, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                  {{--   <div class="d-flex justify-content-center mt-4 mb-6">
                        <button type="button" class="btn btn-light-primary btn-sm" onclick="openCheckoutLeadsModal()">
                            <i class="ki-duotone ki-plus fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            +1017 leads
                        </button>
                    </div> --}}

                    <div class="d-flex justify-content-end mt-10">
                       <form action="{{ route('checkout.process') }}" method="post">
                            @csrf
                            <button type="submit" id="finalizarCompraFinal" class="btn btn-pink text-white">
                                Finalizar Compra
                                <i class="ki-duotone ki-exit-right-corner fs-2 text-white ms-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="checkoutLeadsModal" tabindex="-1" aria-labelledby="checkoutLeadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutLeadsModalLabel">
                    <i class="ki-duotone ki-people fs-2 me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>
                    Todos os Leads Selecionados (1024)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-rounded table-striped border gy-5 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                <th class="min-w-200px">Lead</th>
                                <th class="min-w-125px">Fornecedor</th>
                                <th class="min-w-100px text-center">Avaliação</th>
                                <th class="min-w-80px text-end">Preço</th>
                            </tr>
                        </thead>
                        <tbody id="checkout-modal-leads-tbody">

                        </tbody>
                    </table>
                </div>


                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Exibindo <span id="checkout-showing-from">1</span> a <span id="checkout-showing-to">20</span> de <span id="checkout-total-leads">1024</span> leads
                    </div>
                    <nav aria-label="Paginação dos leads">
                        <ul class="pagination pagination-sm" id="checkout-leads-pagination">

                        </ul>
                    </nav>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="proceedToConfirmation()">
                    <i class="ki-duotone ki-arrow-right fs-4 me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Prosseguir para Confirmação
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
