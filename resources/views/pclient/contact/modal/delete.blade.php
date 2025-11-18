<div class="modal fade" id="deletecontact-{{ $contact->id }}" tabindex="-1" aria-labelledby="deletecontactLabel-{{ $contact->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary">
                <h5 class="modal-title fs-3 text-danger" id="deletecontactLabel-{{ $contact->id }}">
                    Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-8 px-8">
                <div class="text-center">
                    <p class="fs-6 text-gray-600 mb-2">Tem certeza que deseja excluir o contato:</p>
                    <p class="fs-5 fw-bold text-gray-800 mb-4 text-decoration-underline">"{{ $contact->name }}"</p>
                    <div class="alert alert-warning border-0 bg-light-warning">
                        <div class="d-flex align-items-center">
                            <i class="ki-duotone ki-information-5 fs-2 text-warning me-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <div class="text-start">
                                <span class="fw-bold text-warning">Atenção!</span>
                                <br>
                                <span class="fs-7 text-gray-700">Esta ação não poderá ser desfeita.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-5 me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Cancelar
                </button>
                <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="ki-duotone ki-trash fs-5 me-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                        Sim, excluir!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>