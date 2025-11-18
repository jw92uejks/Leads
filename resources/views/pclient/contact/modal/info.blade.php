<div class="modal fade" id="vercontact-{{ $contact->id }}" tabindex="-1" aria-labelledby="vercontactLabel-{{ $contact->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary">
                <h5 class="modal-title fs-3" id="vercontactLabel-{{ $contact->id }}">Informações do Contato #{{ $contact->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-8 px-8">
                <div class="row g-6 mb-4">
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Nome</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Tipo de Cadastro</label>
                            <span class="fs-6 fw-bold text-gray-800">
                                @if($contact->type)
                                    <span class="badge badge-light-{{ $contact->type == \App\Enums\Lead\LeadType::PF ? 'tertiaryc' : ($contact->type == \App\Enums\Lead\LeadType::PJ ? 'info' : 'warning') }}">
                                        {{ $contact->type->label() }}
                                    </span>
                                @else
                                    <span class="badge badge-light-secondary">N/A</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Status</label>
                            <span class="fs-6 fw-bold text-gray-800">
                                @if($contact->status)
                                    <span class="badge badge-{{ $contact->status->color() }}">{{ $contact->status->label() }}</span>
                                @else
                                    N/A
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                @if($contact->type == \App\Enums\Lead\LeadType::PF || $contact->type == \App\Enums\Lead\LeadType::ADESAO)
                <div class="row g-6 mb-4">
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Telefone</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->phone ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">CPF</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->cpf ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Última Atualização</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                @else
                <div class="row g-6 mb-4">
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Telefone</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->phone ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Razão Social</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->corporateName ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">CNPJ</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->cnpj ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row g-6 mb-4">
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">E-mail</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Cidade / Estado</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->city ?? 'N/A' }} - {{ $contact->state ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Fonte</label>
                            <span class="fs-6 fw-bold text-gray-800">
                                @if($contact->source)
                                    <span>{{ $contact->source->label() }}</span>
                                @else
                                    N/A
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row g-6 mb-4">
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Quantidade de Vidas</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->lifes ?? 0 }} vidas</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Temperatura do Lead</label>
                            <span class="fs-6 fw-bold text-gray-800">
                                @switch($contact->temperature)
                                    @case('hot')
                                        <span class="badge badge-danger">Quente</span>
                                        @break
                                    @case('warm')
                                        <span class="badge badge-warning">Morno</span>
                                        @break
                                    @case('cold')
                                        <span class="badge badge-info">Frio</span>
                                        @break
                                    @default
                                        N/A
                                @endswitch
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Etapa</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->step ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                <div class="row g-6 mb-4">
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Aceita Contestação</label>
                            <span class="fs-6 fw-bold text-gray-800">
                                @if($contact->acceptContestation)
                                    <span>Sim</span>
                                @else
                                    <span>Não</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Data de Aquisição</label>
                            <span class="fs-6 fw-bold text-gray-800">
                                {{ $contact->acquired_at ? $contact->acquired_at->format('d/m/Y') : 'N/A' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Último Contato</label>
                            <span class="fs-6 fw-bold text-gray-800">
                                {{ $contact->last_contact_at ? $contact->last_contact_at->format('d/m/Y H:i') : 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row g-6 mb-4">
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Data de Criação</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Data de Conversão</label>
                            <span class="fs-6 fw-bold text-gray-800">
                                {{ $contact->converted_at ? $contact->converted_at->format('d/m/Y H:i') : 'N/A' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column">
                            <label class="fs-6 fw-semibold text-muted">Motivo da Conversão</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->conversion_reason ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                <div class="row g-6 my-4">
                    <div class="col-6">
                        <div class="d-flex flex-column border rounded p-4">
                            <label class="fs-6 fw-semibold text-muted">Descrição</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->description ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column border rounded p-4">
                            <label class="fs-6 fw-semibold text-muted">Observações</label>
                            <span class="fs-6 fw-bold text-gray-800">{{ $contact->notes ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
