<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold fs-4" id="editEventModalLabel">Editar Agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form id="editEventForm">
                <input type="hidden" id="editEventId">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Título *</label>
                            <input type="text" class="form-control" id="editEventTitleInput" name="title" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea class="form-control" id="editEventDescriptionInput" name="description" rows="3"></textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Data/Hora Início *</label>
                            <input type="datetime-local" class="form-control" id="editEventStartDate" name="start_date" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Data/Hora Fim</label>
                            <input type="datetime-local" class="form-control" id="editEventEndDate" name="end_date">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Tipo</label>
                            <select class="form-control" id="editEventType" name="type">
                                <option value="appointment">Consulta</option>
                                <option value="meeting">Reunião</option>
                                <option value="reminder">Lembrete</option>
                                <option value="task">Tarefa</option>
                                <option value="personal">Pessoal</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Cor</label>
                            <input type="color" class="form-control" id="editEventColor" name="color" value="#3788d8">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Localização</label>
                            <input type="text" class="form-control" id="editEventLocation" name="location">
                        </div>
                        <div class="col-6">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" id="editAllDayCheck" name="all_day" />
                                <label class="form-check-label" for="editAllDayCheck">
                                    Dia inteiro
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-small" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-small">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
