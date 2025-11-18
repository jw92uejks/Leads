<div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold fs-4" id="createEventModalLabel">Criar Agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form id="createEventForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Título *</label>
                            <input type="text" class="form-control" id="eventTitleInput" name="title" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea class="form-control" id="eventDescriptionInput" name="description" rows="3"></textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Data/Hora Início *</label>
                            <input type="datetime-local" class="form-control" id="eventStartDate" name="start_date" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Data/Hora Fim</label>
                            <input type="datetime-local" class="form-control" id="eventEndDate" name="end_date">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Tipo</label>
                            <select class="form-control" name="type">
                                <option value="appointment">Consulta</option>
                                <option value="meeting">Reunião</option>
                                <option value="reminder">Lembrete</option>
                                <option value="task">Tarefa</option>
                                <option value="personal">Pessoal</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Cor</label>
                            <input type="color" class="form-control" name="color" value="#3788d8">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Localização</label>
                            <input type="text" class="form-control" name="location">
                        </div>
                        <div class="col-6">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" name="all_day" id="allDayCheck">
                                <label class="form-check-label" for="allDayCheck">Dia inteiro</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-small" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-small">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
