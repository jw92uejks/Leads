<div class="modal fade" id="editcontact-{{ $contact->id }}" tabindex="-1" aria-labelledby="editcontactLabel-{{ $contact->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content">
            <!-- <form method="POST" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('contact.update', $contact->id) }}" id="editcontact-form-{{ $contact->id }}"> -->
            <form method="POST" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route('contact.update', ['id' => $contact->id ])}}" id="editcontact-form-{{ $contact->id }}">
                @csrf
                <!-- @method('PUT') -->
                <input type="hidden" name="close_modal" value="1">
                <div class="modal-header" id="editcontact-header-{{ $contact->id }}">
                    <h1 class="fw-bold fs-3">Editar Contato #{{ $contact->id }}</h1>
                    <div id="editcontact-close-{{ $contact->id }}" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-5">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="scroll-y me-n7 pe-7" id="editcontact-scroll-{{ $contact->id }}" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#editcontact-header-{{ $contact->id }}" data-kt-scroll-wrappers="#editcontact-scroll-{{ $contact->id }}" data-kt-scroll-offset="300px" style="max-height: 645px;">
                        <div class="row g-9 mb-7">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Nome</label>
                                <input type="text" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Nome completo" name="name" value="{{ old('name', $contact->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Telefone</label>
                                <input type="text" class="form-control form-control-solid @error('phone') is-invalid @enderror" placeholder="(11) 99999-9999" name="phone" value="{{ old('phone', $contact->phone) }}" />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-9 mb-7">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">E-mail</label>
                                <input type="email" class="form-control form-control-solid @error('email') is-invalid @enderror" placeholder="exemplo@email.com" name="email" value="{{ old('email', $contact->email) }}" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Tipo de Cadastro</label>
                                <select class="form-select form-select-solid @error('type') is-invalid @enderror" name="type">
                                    <option value="1" {{ old('type', $contact->type?->value) == 1 ? 'selected' : '' }}>Pessoa Física</option>
                                    <option value="2" {{ old('type', $contact->type?->value) == 2 ? 'selected' : '' }}>Pessoa Jurídica</option>
                                    <option value="3" {{ old('type', $contact->type?->value) == 3 ? 'selected' : '' }}>Adesão</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-9 mb-7">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Cidade</label>
                                <input type="text" class="form-control form-control-solid @error('city') is-invalid @enderror" placeholder="Cidade" name="city" value="{{ old('city', $contact->city) }}" />
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Estado</label>
                                <input type="text" class="form-control form-control-solid @error('state') is-invalid @enderror" placeholder="UF" name="state" value="{{ old('state', $contact->state) }}" />
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-9 mb-7">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Empresa</label>
                                <input type="text" class="form-control form-control-solid @error('company') is-invalid @enderror" placeholder="Nome da empresa" name="company" value="{{ old('company', $contact->company) }}" />
                                @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Quantidade de Vidas</label>
                                <input type="number" class="form-control form-control-solid @error('lifes') is-invalid @enderror" placeholder="0" name="lifes" min="0" value="{{ old('lifes', $contact->lifes) }}" />
                                @error('lifes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-9 mb-7">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">CPF</label>
                                <input type="text" class="form-control form-control-solid @error('cpf') is-invalid @enderror" placeholder="000.000.000-00" name="cpf" value="{{ old('cpf', $contact->cpf) }}" />
                                @error('cpf')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">CNPJ</label>
                                <input type="text" class="form-control form-control-solid @error('cnpj') is-invalid @enderror" placeholder="00.000.000/0000-00" name="cnpj" value="{{ old('cnpj', $contact->cnpj) }}" />
                                @error('cnpj')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-9 mb-7">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Temperatura do Lead</label>
                                <select class="form-select form-select-solid @error('temperature') is-invalid @enderror" name="temperature">
                                    <option value="">Selecione a temperatura</option>
                                    <option value="hot" {{ old('temperature', $contact->temperature) == 'hot' ? 'selected' : '' }}>Quente</option>
                                    <option value="warm" {{ old('temperature', $contact->temperature) == 'warm' ? 'selected' : '' }}>Morno</option>
                                    <option value="cold" {{ old('temperature', $contact->temperature) == 'cold' ? 'selected' : '' }}>Frio</option>
                                </select>
                                @error('temperature')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Preço Inicial</label>
                                <input type="number" class="form-control form-control-solid @error('startPrice') is-invalid @enderror" placeholder="0.00" name="startPrice" step="0.01" min="0" value="{{ old('startPrice', $contact->startPrice) }}" />
                                @error('startPrice')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-9 mb-7">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Preço Atual</label>
                                <input type="number" class="form-control form-control-solid @error('currentPrice') is-invalid @enderror" placeholder="0.00" name="currentPrice" step="0.01" min="0" value="{{ old('currentPrice', $contact->currentPrice) }}" />
                                @error('currentPrice')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Tipo de Precificação</label>
                                <select class="form-select form-select-solid @error('pricingType') is-invalid @enderror" name="pricingType">
                                    <option value="">Selecione o tipo</option>
                                    <option value="fixed" {{ old('pricingType', $contact->pricingType) == 'fixed' ? 'selected' : '' }}>Fixo</option>
                                    <option value="monthly" {{ old('pricingType', $contact->pricingType) == 'monthly' ? 'selected' : '' }}>Mensal</option>
                                    <option value="annual" {{ old('pricingType', $contact->pricingType) == 'annual' ? 'selected' : '' }}>Anual</option>
                                </select>
                                @error('pricingType')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-9 mb-7">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Percentual de Depreciação</label>
                                <input type="number" class="form-control form-control-solid @error('depreciationPercent') is-invalid @enderror" placeholder="0" name="depreciationPercent" min="0" max="100" value="{{ old('depreciationPercent', $contact->depreciationPercent) }}" />
                                @error('depreciationPercent')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Intervalo de Depreciação (meses)</label>
                                <input type="number" class="form-control form-control-solid @error('depreciationInterval') is-invalid @enderror" placeholder="0" name="depreciationInterval" min="0" value="{{ old('depreciationInterval', $contact->depreciationInterval) }}" />
                                @error('depreciationInterval')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-9 mb-7">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Data de Expiração do Lead</label>
                                <input type="date" class="form-control form-control-solid @error('lead_expires_at') is-invalid @enderror" name="lead_expires_at" value="{{ old('lead_expires_at', $contact->lead_expires_at ? $contact->lead_expires_at->format('Y-m-d') : '') }}" />
                                @error('lead_expires_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Data de Aquisição</label>
                                <input type="date" class="form-control form-control-solid @error('acquired_at') is-invalid @enderror" name="acquired_at" value="{{ old('acquired_at', $contact->acquired_at ? $contact->acquired_at->format('Y-m-d') : '') }}" />
                                @error('acquired_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Descrição</label>
                            <textarea class="form-control form-control-solid @error('description') is-invalid @enderror" rows="3" placeholder="Descrição detalhada do contato" name="description">{{ old('description', $contact->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Observações</label>
                            <textarea class="form-control form-control-solid @error('notes') is-invalid @enderror" rows="3" placeholder="Observações adicionais" name="notes">{{ old('notes', $contact->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">
                            Atualizar Contato
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
