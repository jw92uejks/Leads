<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold fs-4" id="eventModalLabel">Detalhes do Agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <strong>Título:</strong>
                        <p id="eventTitle"></p>
                    </div>
                    <div class="col-12 mb-3">
                        <strong>Descrição:</strong>
                        <p id="eventDescription"></p>
                    </div>
                    <div class="col-6 mb-3">
                        <strong>Início:</strong>
                        <p id="eventStart"></p>
                    </div>
                    <div class="col-6 mb-3">
                        <strong>Fim:</strong>
                        <p id="eventEnd"></p>
                    </div>
                    <div class="col-12 mb-3">
                        <strong>Localização:</strong>
                        <p id="eventLocation"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div>
                    <button type="button" class="btn btn-danger btn-small" id="deleteEventBtn">Excluir Agendamento</button>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary btn-small me-2" id="completeEventBtn">Concluir</button>
                    <button type="button" class="btn btn-info btn-small" id="editEventBtn">Editar</button>
                </div>
            </div>
        </div>
    </div>
</div>
