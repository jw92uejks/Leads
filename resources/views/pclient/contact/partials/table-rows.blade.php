@if($contacts->count() > 0)
    @foreach($contacts as $contact)
    <tr>
        <td>
            <a href="#" class="text-gray-800 text-hover-primary mb-1">#{{ $contact->id }}</a>
        </td>
        <td>
            {{ $contact->name }}
        </td>
        <td>
            {{ $contact->city ?? 'N/A' }}
        </td>
        <td>
            {{ app(App\Services\ContactService::class)->getTypeLabel($contact) }}
        </td>
        <td>
            {{ $contact->lifes ?? 0 }} vidas
        </td>
        <td data-order="{{ $contact->created_at->format('Y-m-d\TH:i:s') }}">
            {{ $contact->created_at->format('d/m/Y') }}
        </td>
        <td class="text-end">
            <div class="d-flex justify-content-end flex-shrink-0">
                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Visualizar">
                    <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-xs me-1" data-bs-toggle="modal" data-bs-target="#vercontact-{{ $contact->id }}">
                        <i class="ki-duotone ki-eye fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </button>
                </span>
                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Editar">
                    <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-xs me-1" data-bs-toggle="modal" data-bs-target="#editcontact-{{ $contact->id }}">
                        <i class="ki-duotone ki-pencil fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                </span>
                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Excluir">
                    <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-xs me-1" title="Excluir" data-bs-toggle="modal" data-bs-target="#deletecontact-{{ $contact->id }}">
                        <i class="ki-duotone ki-trash fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </button>
                </span>
            </div>
        </td>
    </tr>

    @include('pclient.contact.modal.info', ['contact' => $contact])
    @include('pclient.contact.modal.edit', ['contact' => $contact])
    @include('pclient.contact.modal.delete', ['contact' => $contact])

    @endforeach

@else
    <tr>
        <td colspan="7" class="text-center py-10">
            <div class="text-center">
                <div class="text-muted mb-3">Nenhum contato encontrado</div>
                <div class="text-muted fs-7">Tente ajustar os filtros de busca</div>
            </div>
        </td>
    </tr>
@endif
