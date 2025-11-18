@extends('layouts.app')
@section('title', 'Transferência de Leads')
@section('team-panel', 'active')

@section('headlocal') @includeIf('pclient.team-panel.jscss.css') @endsection
{{-- JavaScript removido - implementar funcionalidades no backend --}}

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Transferência de Leads</h1>
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
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('team-panel.single-team.show', $id) }}" class="text-muted text-hover-primary">Equipe Alpha</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Transferência de Leads</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('team-panel.index') }}" class="btn btn-light-secondary">
                        <i class="ki-duotone ki-arrow-left fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>Todas as Equipes
                    </a>
                </div>
            </div>
        </div>

        <div id="kt_app_content_container" class="app-container">
            <!--begin::Menu Interno da Equipe-->
            <div class="card card-flush mb-6">
                <div class="card-body p-0">
                    <div class="nav nav-tabs nav-line-tabs nav-stretch border-transparent fs-5 fw-bold" style="overflow-x: auto; overflow-y: hidden;">
                        <a class="nav-link text-active-primary border-transparent me-3" href="{{ route('team-panel.single-team.show', $id) }}">
                            <i class="ki-duotone ki-element-11 fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>Visão Geral
                        </a>
                        <a class="nav-link text-active-primary border-transparent me-3" href="{{ route('team-panel.single-team.edit', $id) }}">
                            <i class="ki-duotone ki-pencil fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Editar Equipe
                        </a>
                        <a class="nav-link text-active-primary border-transparent me-3" href="{{ route('team-panel.single-team.members', $id) }}">
                            <i class="ki-duotone ki-profile-user fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>Membros
                        </a>
                        <a class="nav-link text-active-primary border-transparent me-3" href="{{ route('team-panel.single-team.access', $id) }}">
                            <i class="ki-duotone ki-lock fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Controle de Acessos
                        </a>
                        <a class="nav-link text-active-primary border-transparent me-3 active" href="{{ route('team-panel.single-team.transfer', $id) }}">
                            <i class="ki-duotone ki-arrow-right-left fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Transferência de Leads
                        </a>
                    </div>
                </div>
            </div>
            <!--end::Menu Interno da Equipe-->

            <!--begin::Card de Filtros-->
            <div class="card card-flush mb-6">
                <div class="card-header">
                    <h3 class="card-title pt-5">Filtrar Leads para Transferência</h3>
                </div>
                <div class="card-body">
                    <div class="row g-6">
                        <div class="col-md-3">
                            <label class="form-label">Tipo de Lead</label>
                            <select class="form-select form-select-solid" id="filter_lead_type">
                                <option value="">Todos os tipos</option>
                                <option value="1">Pessoa Física</option>
                                <option value="2">Pessoa Jurídica</option>
                                <option value="3">Adesão</option>
                                <option value="4">Mista</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Operadora</label>
                            <select class="form-select form-select-solid" id="filter_operadora">
                                <option value="">Todas as operadoras</option>
                                @foreach($leadsAcquired->pluck('healthOperator.name')->filter()->unique() as $operadora)
                                    <option value="{{ $operadora }}">{{ $operadora }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">DDD</label>
                            <select class="form-select form-select-solid" id="filter_ddd">
                                <option value="">Todos os DDDs</option>
                                @foreach($leadsAcquired->filter(fn($lead) => $lead->phone)->map(fn($lead) => substr(preg_replace('/[^0-9]/', '', $lead->phone), 0, 2))->unique()->sort() as $ddd)
                                    <option value="{{ $ddd }}">{{ $ddd }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Data de Aquisição</label>
                            <input type="date" class="form-control form-control-solid" id="filter_date" placeholder="Filtrar por data">
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card de Filtros-->

            <!--begin::Card de Leads do Proprietário-->
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title pt-5">Meus Leads Adquiridos</h3>
                </div>
                <div class="card-body">
                    <!--begin::Tabela de Leads-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="leads_transfer_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-200px">Lead</th>
                                    <th class="min-w-150px">Tipo</th>
                                    <th class="min-w-150px">Operadora</th>
                                    <th class="min-w-150px">Data de Aquisição</th>
                                    <th class="min-w-100px">DDD</th>
                                    <th class="min-w-100px">Transferir</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @forelse ($leadsAcquired as $lead)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-4">
                                                <i class="ki-duotone ki-profile-circle me-3" style="font-size: 2.5rem; color: #D91D75;">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text-dark">{{ $lead->name ?? 'N/A' }}</div>
                                                <div class="text-muted fs-7">{{ $lead->email ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-{{ $lead->type === \App\Enums\Lead\LeadType::PF ? 'primary' : ($lead->type === \App\Enums\Lead\LeadType::PJ ? 'info' : 'warning') }}"
                                              style="{{ $lead->type === \App\Enums\Lead\LeadType::PF ? 'background-color: rgba(116, 103, 239, 0.1); color: #7467ef;' : '' }}">
                                            {{ $lead->type?->label() ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <td data-operadora="{{ $lead->healthOperator?->name ?? 'N/A' }}">
                                        <div class="d-flex align-items-start" style="min-height: 50px;">
                                            @if($lead->healthOperator && $lead->healthOperator->logo)
                                                <img src="{{ asset($lead->healthOperator->logo) }}" alt="{{ $lead->healthOperator->name }}" style="width: 75px; height: auto; object-fit: contain; display: block;">
                                            @else
                                                <img src="{{ asset('assets/images/suppliers/mixed_supplier.png') }}" alt="Operadora" style="width: 75px; height: auto; object-fit: contain; display: block;">
                                            @endif
                                        </div>
                                    </td>
                                    <td data-order="{{ $lead->acquired_at?->format('Y-m-d') ?? '' }}">
                                        {{ $lead->acquired_at?->format('d/m/Y') ?? 'N/A' }}
                                    </td>
                                    <td>
                                        <span class="text-gray-700">
                                            @if($lead->phone)
                                                DDD ({{ substr(preg_replace('/[^0-9]/', '', $lead->phone), 0, 2) }})
                                            @else
                                                {{ $lead->city ?? 'N/A' }}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                              <button class="btn btn-sm btn-light-primary transfer-responsibility-btn" data-lead-id="{{ $lead->id }}" data-lead-name="{{ $lead->name }}">
                                                <i class="ki-duotone ki-user-check fs-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>Responsabilidade
                                            </button>
                                              <button class="btn btn-sm btn-light-danger transfer-ownership-btn" data-lead-id="{{ $lead->id }}" data-lead-name="{{ $lead->name }}">
                                                <i class="ki-duotone ki-arrow-right-left fs-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>Titularidade
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-10">
                                        <div class="text-gray-500">
                                            <i class="ki-duotone ki-folder fs-5x text-gray-300 mb-5">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <h3 class="text-gray-700 fw-bold fs-2 mb-3">Nenhum lead adquirido</h3>
                                            <p class="text-gray-500">Você ainda não possui leads adquiridos para transferir.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!--end::Tabela de Leads-->
                </div>
            </div>
            <!--end::Card de Leads do Proprietário-->
        </div>
    </div>

    @include('pclient.team-panel.modals.responsibility')
    @include('pclient.team-panel.modals.ownership')

    <div class="py-10"></div>
@endsection

@section('jslocal')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== TRANSFER SCRIPT LOADED ===');
    
    // Variáveis globais para validação
    let currentLeadData = null;

    /**
     * Atualizar modal de responsabilidade com dados do lead
     */
    function updateResponsibilityModal(leadData) {
        const nameElement = document.getElementById('singleLeadNameResponsibility');
        if (nameElement) {
            nameElement.textContent = leadData.name || 'N/A';
        }
    }

    /**
     * Atualizar modal de titularidade com dados do lead
     */
    function updateOwnershipModal(leadData) {
        const nameElement = document.getElementById('singleLeadNameOwnership');
        const confirmationField = document.querySelector('#transferSingleOwnershipModal input[name="confirmation_text"]');
        
        if (nameElement) {
            nameElement.textContent = leadData.name || 'N/A';
        }
        
        if (confirmationField) {
            confirmationField.placeholder = `Digite "${leadData.name || 'N/A'}" para confirmar`;
            confirmationField.value = ''; // Limpar campo
        }
    }

    /**
     * Abrir modal de transferência de responsabilidade
     */
    function openResponsibilityModal(leadData) {
        console.log('Opening responsibility modal for lead:', leadData);
        
        currentLeadData = leadData;
        updateResponsibilityModal(leadData);
        
        // Abrir o modal
        const modal = new bootstrap.Modal(document.getElementById('transferSingleResponsibilityModal'));
        modal.show();
    }

    /**
     * Abrir modal de transferência de titularidade
     */
    function openOwnershipModal(leadData) {
        console.log('Opening ownership modal for lead:', leadData);
        
        currentLeadData = leadData;
        updateOwnershipModal(leadData);
        
        // Abrir o modal
        const modal = new bootstrap.Modal(document.getElementById('transferSingleOwnershipModal'));
        modal.show();
    }

    // Event listeners para botões de transferência de responsabilidade
    const responsibilityButtons = document.querySelectorAll('.transfer-responsibility-btn');
    console.log('Found responsibility buttons:', responsibilityButtons.length);
    
    responsibilityButtons.forEach(button => {
        button.addEventListener('click', function() {
            const leadId = this.getAttribute('data-lead-id');
            const leadName = this.getAttribute('data-lead-name');
            console.log('Responsibility button clicked, leadId:', leadId, 'leadName:', leadName);
            
            const leadData = {
                id: leadId,
                name: leadName
            };
            
            openResponsibilityModal(leadData);
        });
    });

    // Event listeners para botões de transferência de titularidade
    const ownershipButtons = document.querySelectorAll('.transfer-ownership-btn');
    console.log('Found ownership buttons:', ownershipButtons.length);
    
    ownershipButtons.forEach(button => {
        button.addEventListener('click', function() {
            const leadId = this.getAttribute('data-lead-id');
            const leadName = this.getAttribute('data-lead-name');
            console.log('Ownership button clicked, leadId:', leadId, 'leadName:', leadName);
            
            const leadData = {
                id: leadId,
                name: leadName
            };
            
            openOwnershipModal(leadData);
        });
    });

    // Configurar validação do campo de confirmação de titularidade
    const confirmationField = document.querySelector('#transferSingleOwnershipModal input[name="confirmation_text"]');
    if (confirmationField) {
        confirmationField.addEventListener('input', function() {
            const inputValue = this.value.trim();
            const expectedText = currentLeadData?.name || '';
            
            if (inputValue === expectedText) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
            }
        });
    }

    console.log('=== TRANSFER SCRIPT SETUP COMPLETED ===');
});
</script>
@endsection
