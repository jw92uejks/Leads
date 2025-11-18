<div class="modal fade" id="kt_modal_view_leads" tabindex="-1" aria-hidden="true" x-data="purchaseLeads">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down mw-1200px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold" id="modal_leads_title">Leads Disponíveis - {{ $supplier->name ?? 'Fornecedor' }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header border-0 pt-6 pb-3">
                        <div class="card-title">
                            <h3 class="fw-bold m-0">Lista de Leads Disponíveis</h3>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row g-4" id="leads_grid_container">
                            @php
                                $allLeads = collect();

                                $operadoras = [
                                    'Amil' => 'assets/images/operatorslogos/amil.png',
                                    'Unimed' => 'assets/images/operatorslogos/unimed.png',
                                    'Bradesco Saúde' => 'assets/images/operatorslogos/bradesco.png',
                                    'SulAmérica' => 'assets/images/operatorslogos/sulamerica.png',
                                    'Porto Seguro' => 'assets/images/operatorslogos/porto.png',
                                    'Hapvida' => 'assets/images/operatorslogos/hapvida.png',
                                    'MedSênior' => 'assets/images/operatorslogos/medsenior.png',
                                    'Todas' => 'assets/images/suppliers/mixed_supplier.png'
                                ];

                                // Verificar se há fornecedores disponíveis
                                if (!empty($suppliers) && isset($suppliers[0]) && $suppliers[0]->leads) {
                                    $pfLeads = collect($suppliers[0]->leads)->map(function($lead, $index) use ($operadoras) {
                                        $lead->type_label = 'PF';
                                        $operadorasKeys = array_keys($operadoras);
                                        $operadoraKey = $operadorasKeys[$index % count($operadorasKeys)];
                                        $lead->operadora = $operadoraKey;
                                        $lead->thumb = $operadoras[$operadoraKey];
                                        $lead->isMixed = ($operadoraKey === 'Todas');
                                        return $lead;
                                    });

                                    $pmeLeads = collect($suppliers[0]->leads)->map(function($lead, $index) use ($operadoras) {
                                        $lead->type_label = 'PJ';
                                        $operadorasKeys = array_keys($operadoras);
                                        $operadoraKey = $operadorasKeys[($index + 3) % count($operadorasKeys)];
                                        $lead->operadora = $operadoraKey;
                                        $lead->thumb = $operadoras[$operadoraKey];
                                        $lead->isMixed = ($operadoraKey === 'Todas');
                                        return $lead;
                                    });

                                    $adesaoLeads = collect($suppliers[0]->leads)->map(function($lead, $index) use ($operadoras) {
                                        $lead->type_label = 'ADESAO';
                                        $operadorasKeys = array_keys($operadoras);
                                        $operadoraKey = $operadorasKeys[($index + 6) % count($operadorasKeys)];
                                        $lead->operadora = $operadoraKey;
                                        $lead->thumb = $operadoras[$operadoraKey];
                                        $lead->isMixed = ($operadoraKey === 'Todas');
                                        return $lead;
                                    });
                                } else {
                                    $pfLeads = collect();
                                    $cnpjLeads = collect();
                                    $mistoLeads = collect();
                                }

                                                                    $allLeads = $pfLeads->merge($pmeLeads)->merge($adesaoLeads);
                                $perPage = 9;
                                $currentPage = request()->get('page', 1);
                                $paginatedLeads = $allLeads->forPage($currentPage, $perPage);
                                $totalPages = ceil($allLeads->count() / $perPage);
                            @endphp

                            @foreach ($paginatedLeads as $index => $lead)
                            <div class="col-md-4">
                                <div class="card h-100 lead-item-card">
                                    <div class="card-body p-0">
                                        <div class="d-flex h-100">
                                            <div class="lead-thumb-section d-flex align-items-center justify-content-center position-relative" style="width: 33%;">
                                                <div class="form-check position-absolute top-0 start-0 m-2">
                                                    <input class="form-check-input" type="checkbox" value="{{ $lead->id }}" data-lead="{{ json_encode(['id' => $lead->id, 'name' => $lead->name, 'supplier' => $lead->supplier->name, 'price' => (float) $lead->currentPrice]) }}" />
                                                </div>
                                                <div class="lead-thumb-image" style="width: 100%; height: 100%;">
                                                    <img src="{{ asset($lead->thumb) }}" alt="Fornecedor" class="w-100 h-100 object-fit-contain">
                                                </div>
                                            </div>
                                            <div class="lead-info-section flex-grow-1 p-4" style="width: 67%;">
                                                <div class="mb-3">
                                                    @if($lead->isMixed)
                                                        <span class="badge badge-light-warning">Lead Misto</span>
                                                    @elseif($lead->type_label === 'PF')
                                                        <span class="badge" style="background-color: rgba(116, 103, 239, 0.1); color: #7467ef;">Pessoa Física</span>
                                                    @elseif($lead->type_label === 'PJ')
                                                        <span class="badge badge-light-info">Pessoa Jurídica</span>
                                                    @elseif($lead->type_label === 'ADESAO')
                                                        <span class="badge badge-light-warning">Adesão</span>
                                                    @endif
                                                </div>

                                                <div class="lead-info-item mb-2">
                                                    <i class="ki-duotone ki-geolocation text-gray-500 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    <span class="text-gray-700"><strong>Região</strong> DDD ({{ substr($lead->phone, 0, 2) }})</span>
                                                </div>

                                                <div class="lead-info-item mb-2">
                                                    <i class="ki-duotone ki-time text-gray-500 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    <span class="text-gray-700"><strong>Criado em</strong> {{ $lead->created_at->format('d/m/y') }} às {{ $lead->created_at->format('H:i:s') }}</span>
                                                </div>

                                                <div class="lead-info-item mb-3">
                                                    <i class="ki-duotone ki-check-square text-gray-500 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    <span class="text-gray-700"><strong>Operadora</strong> {{ $lead->operadora }}</span>
                                                </div>

                                                <div class="lead-price">
                                                    <span class="fw-bold fs-5" style="color: #f1416c;">R$ {{ number_format($lead->currentPrice, 2, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($totalPages > 1)
                        <div class="d-flex justify-content-center mt-6">
                            <nav aria-label="Paginação dos leads">
                                <ul class="pagination">
                                    @if($currentPage > 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}" aria-label="Anterior">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    @endif

                                    @for($i = 1; $i <= $totalPages; $i++)
                                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                            <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    @if($currentPage < $totalPages)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}" aria-label="Próximo">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" x-on:click="handlePurchaseLeads()">
                    <i class="ki-duotone ki-check fs-2"></i>
                    Prosseguir com Compra
                </button>
            </div>
        </div>
    </div>
</div>
