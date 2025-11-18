<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>

<script>
    "use strict";

    var KTGeneralFullCalendarBasicDemos = function () {
        var exampleBasic = function () {
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            var calendarEl = document.getElementById('kt_docs_fullcalendar_basic');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'pt-br',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },

                responsiveBreakpoint: 768,

                titleRangeSeparator: ' - ',

                buttonText: {
                    today: 'Hoje',
                    month: 'Mês',
                    week: 'Semana',
                    day: 'Dia',
                    list: 'Lista'
                },

                height: 'auto',
                contentHeight: 'auto',
                aspectRatio: 1.8,

                nowIndicator: true,
                now: TODAY + 'T09:25:00',

                initialView: 'dayGridMonth',
                initialDate: TODAY,

                editable: true,
                dayMaxEvents: true,
                navLinks: true,

                events: {
                    url: '{{ route("calendar.events") }}',
                    method: 'GET',
                    extraParams: function() {
                        return {};
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    failure: function(error) {
                        console.error('Erro ao carregar agendamentos:', error);
                        alert('Erro ao carregar agendamentos da agenda.');
                    }
                },

                eventClick: function(info) {
                    info.jsEvent.preventDefault();

                    if (info.event.url) {
                        window.open(info.event.url);
                        return false;
                    }

                    showEventModal(info.event);
                },

                dateClick: function(info) {
                    showCreateEventModal(info.dateStr);
                },

                eventDrop: function(info) {
                    updateEventDate(info);
                },

                eventResize: function(info) {
                    updateEventDate(info);
                },

                eventContent: function (info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                }
            });

            calendar.render();
            return calendar;
        }

        return {
            init: function () {
                return exampleBasic();
            },
            getCalendar: function() {
                return calendar;
            }
        };
    }();

    function showEventModal(event) {
        document.getElementById('eventTitle').textContent = event.title;
        document.getElementById('eventDescription').textContent = event.extendedProps.description || 'Sem descrição';
        document.getElementById('eventStart').textContent = formatDateTime(event.start);
        document.getElementById('eventEnd').textContent = event.end ? formatDateTime(event.end) : 'Sem data de fim';
        document.getElementById('eventLocation').textContent = event.extendedProps.location || 'Sem localização';

        document.getElementById('editEventBtn').onclick = () => editEvent(event.id);
        document.getElementById('deleteEventBtn').onclick = () => deleteEvent(event.id);
        document.getElementById('completeEventBtn').onclick = () => completeEvent(event.id);

        const modal = document.getElementById('eventModal');
        modal.addEventListener('shown.bs.modal', function() {
            modal.setAttribute('aria-hidden', 'false');
        });
        modal.addEventListener('hidden.bs.modal', function() {
            modal.setAttribute('aria-hidden', 'true');
        });

        $('#eventModal').modal('show');
    }

    function showCreateEventModal(dateStr) {
        // Converter a data para o formato datetime-local (YYYY-MM-DDTHH:MM)
        const selectedDate = new Date(dateStr + 'T00:00:00');

        // Definir hora padrão de início (09:00)
        selectedDate.setHours(9, 0, 0, 0);
        const formattedStartDate = selectedDate.toISOString().slice(0, 16);

        // Definir hora padrão de fim (10:00) - 1 hora depois
        const endDate = new Date(selectedDate);
        endDate.setHours(10, 0, 0, 0);
        const formattedEndDate = endDate.toISOString().slice(0, 16);

        // Preencher os campos do formulário
        document.getElementById('eventStartDate').value = formattedStartDate;
        document.getElementById('eventEndDate').value = formattedEndDate;

        const modal = document.getElementById('createEventModal');
        modal.addEventListener('shown.bs.modal', function() {
            modal.setAttribute('aria-hidden', 'false');
        });
        modal.addEventListener('hidden.bs.modal', function() {
            modal.setAttribute('aria-hidden', 'true');
        });

        $('#createEventModal').modal('show');
    }

    function createEvent(formData) {
        const eventData = Object.fromEntries(formData);

        // Corrigir conversão do checkbox all_day
        eventData.all_day = eventData.all_day === 'on' || eventData.all_day === '1' || eventData.all_day === true;

        // Se for agendamento de dia inteiro, ajustar as datas
        if (eventData.all_day) {
            if (eventData.start_date) {
                const startDate = new Date(eventData.start_date);
                startDate.setHours(0, 0, 0, 0);
                eventData.start_date = startDate.toISOString().slice(0, 19);
            }
            if (eventData.end_date) {
                const endDate = new Date(eventData.end_date);
                endDate.setHours(23, 59, 59, 999);
                eventData.end_date = endDate.toISOString().slice(0, 19);
            } else if (eventData.start_date) {
                const endDate = new Date(eventData.start_date);
                endDate.setHours(23, 59, 59, 999);
                eventData.end_date = endDate.toISOString().slice(0, 19);
            }
        }

        fetch('{{ route("calendar.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: JSON.stringify(eventData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#createEventModal').modal('hide');
                if (calendar && typeof calendar.refetchEvents === 'function') {
                    calendar.refetchEvents();
                }
                const message = eventData.all_day ?
                    'agendamento de dia inteiro criado com sucesso!' :
                    data.message || 'agendamento criado com sucesso!';
                showAlert('success', message);
            } else {
                showAlert('error', data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showAlert('error', 'Erro ao criar agendamento');
        });
    }

    function updateEventDate(info) {
        const event = info.event;

        const eventData = {
            title: sanitizeString(event.title),
            description: sanitizeString(event.extendedProps.description || ''),
            start_date: event.start.toISOString(),
            end_date: event.end ? event.end.toISOString() : null,
            all_day: Boolean(event.allDay),
            color: sanitizeColor(event.backgroundColor),
            status: sanitizeStatus(event.extendedProps.status || 'scheduled'),
            type: sanitizeType(event.extendedProps.type || 'appointment'),
            location: sanitizeString(event.extendedProps.location || ''),
            attendees: sanitizeAttendees(event.extendedProps.attendees || []),
            metadata: sanitizeMetadata(event.extendedProps.metadata || {})
        };

        fetch(`{{ url('/calendar/events') }}/${event.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: JSON.stringify(eventData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || `HTTP ${response.status}: ${response.statusText}`);
                });
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                showAlert('error', data.message || 'Erro ao atualizar agendamento');
                info.revert();
            } else {
                showAlert('success', 'Agendamento atualizado!');
            }
        })
        .catch(error => {
            console.error('Erro ao atualizar agendamento:', error);
            showAlert('error', error.message || 'Erro ao atualizar agendamento !');
            info.revert();
        });
    }

    function deleteEvent(eventId) {
        if (!confirm('Tem certeza que deseja excluir este agendamento?')) {
            return;
        }

        fetch(`{{ url('/calendar/events') }}/${eventId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#eventModal').modal('hide');
                if (calendar && typeof calendar.refetchEvents === 'function') {
                    calendar.refetchEvents();
                }
                showAlert('success', data.message);
            } else {
                showAlert('error', data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showAlert('error', 'Erro ao excluir agendamento');
        });
    }

    function completeEvent(eventId) {
        fetch(`{{ url('/calendar/events') }}/${eventId}/complete`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#eventModal').modal('hide');
                if (calendar && typeof calendar.refetchEvents === 'function') {
                    calendar.refetchEvents();
                }
                showAlert('success', data.message);
            } else {
                showAlert('error', data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showAlert('error', 'Erro ao completar agendamento');
        });
    }

    function editEvent(eventId) {
        fetch(`{{ url('/calendar/events') }}/${eventId}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showEditEventModal(data.event);
            } else {
                showAlert('error', data.message || 'Erro ao carregar dados do agendamento');
            }
        })
        .catch(error => {
            console.error('Erro ao carregar agendamento:', error);
            showAlert('error', 'Erro ao carregar dados do agendamento');
        });
    }

    function showEditEventModal(event) {
        $('#eventModal').modal('hide');

        document.getElementById('editEventId').value = event.id;
        document.getElementById('editEventTitleInput').value = event.title || '';
        document.getElementById('editEventDescriptionInput').value = event.description || '';
        document.getElementById('editEventLocation').value = event.location || '';
        document.getElementById('editEventColor').value = event.color || '#3788d8';

        if (event.type) {
            document.getElementById('editEventType').value = event.type;
        }

        if (event.start_date) {
            const startDate = new Date(event.start_date);
            const startFormatted = startDate.toISOString().slice(0, 16);
            document.getElementById('editEventStartDate').value = startFormatted;
        }

        if (event.end_date) {
            const endDate = new Date(event.end_date);
            const endFormatted = endDate.toISOString().slice(0, 16);
            document.getElementById('editEventEndDate').value = endFormatted;
        }

        document.getElementById('editAllDayCheck').checked = Boolean(event.all_day);

        const modal = document.getElementById('editEventModal');
        modal.addEventListener('shown.bs.modal', function() {
            modal.setAttribute('aria-hidden', 'false');
        });
        modal.addEventListener('hidden.bs.modal', function() {
            modal.setAttribute('aria-hidden', 'true');
        });

        $('#editEventModal').modal('show');
    }

        function updateEvent(formData, eventId) {
        if (!eventId || isNaN(eventId)) {
            showAlert('error', 'ID do agendamento inválido');
            return;
        }

        const eventData = Object.fromEntries(formData);
        eventData.all_day = eventData.all_day === 'on' || eventData.all_day === '1' || eventData.all_day === true;
        if (eventData.all_day) {
            if (eventData.start_date) {
                const startDate = new Date(eventData.start_date);
                startDate.setHours(0, 0, 0, 0);
                eventData.start_date = startDate.toISOString().slice(0, 19);
            }
            if (eventData.end_date) {
                const endDate = new Date(eventData.end_date);
                endDate.setHours(23, 59, 59, 999);
                eventData.end_date = endDate.toISOString().slice(0, 19);
            } else if (eventData.start_date) {
                const endDate = new Date(eventData.start_date);
                endDate.setHours(23, 59, 59, 999);
                eventData.end_date = endDate.toISOString().slice(0, 19);
            }
        }

        fetch(`{{ url('/calendar/events') }}/${parseInt(eventId)}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: JSON.stringify(eventData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || `HTTP ${response.status}: ${response.statusText}`);
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                $('#editEventModal').modal('hide');
                if (calendar && typeof calendar.refetchEvents === 'function') {
                    calendar.refetchEvents();
                }
                const message = eventData.all_day ?
                    'Agendamento de dia inteiro atualizado!' :
                    'Agendamento atualizado!';
                showAlert('success', message);
            } else {
                const errorMessage = data.message || 'Erro ao atualizar agendamento';
                showAlert('error', errorMessage);
                if (data.errors) {
                    console.error('Validation errors:', data.errors);
                }
            }
        })
        .catch(error => {
            console.error('Erro ao atualizar agendamento:', error);
            showAlert('error', error.message || 'Erro de conexão ou servidor indisponível');
        });
    }

    function formatDateTime(date) {
        return new Date(date).toLocaleString('pt-BR');
    }

    function showAlert(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : type === 'error' ? 'alert-danger' : 'alert-info';
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${escapeHtml(message)}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;

        const container = document.querySelector('#kt_app_content');
        container.insertAdjacentHTML('afterbegin', alertHtml);

        setTimeout(() => {
            const alert = container.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 5000);
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    function sanitizeString(str) {
        if (typeof str !== 'string') return '';
        return str.trim().substring(0, 255);
    }

    function sanitizeColor(color) {
        if (typeof color !== 'string') return '#3788d8';
        return /^#[0-9A-Fa-f]{6}$/.test(color) ? color : '#3788d8';
    }

    function sanitizeStatus(status) {
        const validStatuses = ['scheduled', 'completed', 'cancelled'];
        return validStatuses.includes(status) ? status : 'scheduled';
    }

    function sanitizeType(type) {
        const validTypes = ['appointment', 'meeting', 'reminder', 'task', 'personal'];
        return validTypes.includes(type) ? type : 'appointment';
    }

    function sanitizeAttendees(attendees) {
        if (!Array.isArray(attendees)) return [];
        return attendees.slice(0, 50).filter(email =>
            typeof email === 'string' && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
        );
    }

    function sanitizeMetadata(metadata) {
        if (typeof metadata !== 'object' || metadata === null) return {};
        const keys = Object.keys(metadata).slice(0, 20);
        const sanitized = {};
        keys.forEach(key => {
            if (typeof key === 'string' && key.length <= 50) {
                sanitized[key] = typeof metadata[key] === 'string' ?
                    metadata[key].substring(0, 255) : metadata[key];
            }
        });
        return sanitized;
    }

    let calendar;

    KTUtil.onDOMContentLoaded(function () {
        calendar = KTGeneralFullCalendarBasicDemos.init();

        const createForm = document.getElementById('createEventForm');
        if (createForm) {
            createForm.addEventListener('submit', function(e) {
                e.preventDefault();
                createEvent(new FormData(this));
            });
        }

        const editForm = document.getElementById('editEventForm');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const eventId = document.getElementById('editEventId').value;
                updateEvent(new FormData(this), eventId);
            });
        }
    });
</script>