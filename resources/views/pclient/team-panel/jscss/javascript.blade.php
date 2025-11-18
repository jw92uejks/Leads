<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    "use strict";

    // Função para mostrar notificações
    function showNotification(message, type = 'info') {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: type === 'success' ? 'Sucesso!' : type === 'error' ? 'Erro!' : 'Informação',
                text: message,
                icon: type,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        } else {
            // Fallback para alert simples
            alert(message);
        }
    }

    // Função para reinicializar menus
    function reinitializeMenus() {
        if (typeof KTMenu !== 'undefined') {
            KTMenu.createInstances();
        }
    }

    // Inicializar quando o documento estiver pronto
    $(document).ready(function() {
        // Inicializar tabela unificada de equipes
        initUnifiedTable();
        
        // Funcionalidade para criar equipe e adicionar corretor
        initTeamCorretorFlow();
        
        // Reinicializar menus quando a tabela for redesenhada
        $('#kt_teams_table').on('draw.dt', function() {
            reinitializeMenus();
        });
    });

    // Inicializar tabela de equipes
    function initUnifiedTable() {
        // Destruir tabela existente se houver
        if ($.fn.DataTable.isDataTable('#kt_teams_table')) {
            $('#kt_teams_table').DataTable().destroy();
        }
        
        const teamsTable = $("#kt_teams_table").DataTable({
            "language": {
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Último",
                    "next": "Próximo",
                    "previous": "Anterior"
                }
            },
            "pageLength": 10,
            "lengthChange": false,
            "order": [[2, "desc"]],
            "columnDefs": [
                { "orderable": false, "targets": [4] }
            ],
            "autoWidth": false,
            "responsive": true,
            "processing": false,
            "serverSide": false
        });

        // Filtro de busca de equipes
        $('[data-kt-teams-table-filter="search"]').on("keyup", function() {
            teamsTable.search(this.value).draw();
        });
        
        return teamsTable;
    }

    // Funcionalidade para gerenciar equipes
    function initTeamCorretorFlow() {
        // Busca de usuários para adicionar à equipe
        $('#kt_search_user_team').on('input', function() {
            const query = $(this).val();
            if (query.length >= 2) {
                // Simular busca de usuários
                $('#kt_search_results_team').show();
            } else {
                $('#kt_search_results_team').hide();
            }
        });

        // Validação do formulário de adicionar corretor à equipe
        $('#kt_modal_add_corretor_to_team_form').on('submit', function(e) {
            e.preventDefault();
            const searchUser = $('#kt_search_user_team').val();
            
            if (!searchUser || searchUser.trim() === '') {
                Swal.fire({
                    title: 'Campo Obrigatório',
                    text: 'É necessário buscar e selecionar um usuário.',
                    icon: 'warning',
                    confirmButtonColor: '#e91e63',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            
            // Simular adição de corretor
            showNotification('Corretor adicionado à equipe com sucesso!', 'success');
            $('#kt_modal_add_corretor_to_team').modal('hide');
        });
    }

    // Ações da tabela de equipes
    $(document).on('click', '[data-kt-teams-table-filter="delete_row"]', function() {
        const row = $(this).closest('tr');
        
        Swal.fire({
            title: 'Confirmar Exclusão',
            text: 'Tem certeza que deseja excluir esta equipe?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Simular exclusão
                row.remove();
                showNotification('Equipe excluída com sucesso!', 'success');
            }
        });
    });

    // Ações da tabela de membros
    $(document).on('click', '[data-kt-members-table-filter="remove_member"]', function() {
        const row = $(this).closest('tr');
        const memberName = row.find('td:eq(0) .fw-bold').text();
        
        Swal.fire({
            title: 'Confirmar Remoção',
            text: `Deseja remover ${memberName} desta equipe?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, remover!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Simular remoção
                row.remove();
                showNotification('Membro removido da equipe com sucesso!', 'success');
            }
        });
    });

    // Ações em massa para membros
    $(document).on('click', '[data-kt-bulk-action="activate-members"]', function() {
        const checkedBoxes = $('#kt_members_table input[type="checkbox"]:checked:not([data-kt-members-table-select="all"])');
        
        if (checkedBoxes.length === 0) {
            showNotification('Selecione pelo menos um membro para ativar.', 'warning');
            return;
        }
        
        Swal.fire({
            title: 'Confirmar Ativação',
            text: `Deseja ativar ${checkedBoxes.length} membro(s) selecionado(s)?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sim, ativar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                checkedBoxes.each(function() {
                    const row = $(this).closest('tr');
                    const statusCell = row.find('td:eq(3)');
                    statusCell.html('<span class="badge badge-light-success">Ativo</span>');
                });
                showNotification('Membros ativados com sucesso!', 'success');
                // Limpar seleções
                $('#kt_members_table input[type="checkbox"]').prop('checked', false);
                updateBulkActionsVisibility();
            }
        });
    });

    $(document).on('click', '[data-kt-bulk-action="deactivate-members"]', function() {
        const checkedBoxes = $('#kt_members_table input[type="checkbox"]:checked:not([data-kt-members-table-select="all"])');
        
        if (checkedBoxes.length === 0) {
            showNotification('Selecione pelo menos um membro para desativar.', 'warning');
            return;
        }
        
        Swal.fire({
            title: 'Confirmar Desativação',
            text: `Deseja desativar ${checkedBoxes.length} membro(s) selecionado(s)?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sim, desativar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                checkedBoxes.each(function() {
                    const row = $(this).closest('tr');
                    const statusCell = row.find('td:eq(3)');
                    statusCell.html('<span class="badge badge-light-warning">Inativo</span>');
                });
                showNotification('Membros desativados com sucesso!', 'success');
                // Limpar seleções
                $('#kt_members_table input[type="checkbox"]').prop('checked', false);
                updateBulkActionsVisibility();
            }
        });
    });

    $(document).on('click', '[data-kt-bulk-action="remove-members"]', function() {
        const checkedBoxes = $('#kt_members_table input[type="checkbox"]:checked:not([data-kt-members-table-select="all"])');
        
        if (checkedBoxes.length === 0) {
            showNotification('Selecione pelo menos um membro para remover.', 'warning');
            return;
        }
        
        Swal.fire({
            title: 'Confirmar Remoção',
            text: `Deseja remover ${checkedBoxes.length} membro(s) da equipe?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, remover!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                checkedBoxes.each(function() {
                    const row = $(this).closest('tr');
                    row.remove();
                });
                showNotification('Membros removidos da equipe com sucesso!', 'success');
                // Limpar seleções
                $('#kt_members_table input[type="checkbox"]').prop('checked', false);
                updateBulkActionsVisibility();
            }
        });
    });

    // Atualizar visibilidade das ações em massa
    function updateBulkActionsVisibility() {
        const checkedBoxes = $('#kt_members_table input[type="checkbox"]:checked:not([data-kt-members-table-select="all"])');
        const bulkActionsBtn = $('#kt_bulk_actions_members');
        
        if (checkedBoxes.length > 0) {
            bulkActionsBtn.show();
        } else {
            bulkActionsBtn.hide();
        }
    }

    // Selecionar todos os membros
    $(document).on('change', '[data-kt-members-table-select="all"]', function() {
        const isChecked = $(this).is(':checked');
        $('#kt_members_table input[type="checkbox"]').prop('checked', isChecked);
        updateBulkActionsVisibility();
    });

    // Selecionar membro individual
    $(document).on('change', '#kt_members_table input[type="checkbox"]:not([data-kt-members-table-select="all"])', function() {
        updateBulkActionsVisibility();
    });

    // Formulário de criação de equipe
    $('#kt_create_team_form').on('submit', function(e) {
        e.preventDefault();
        
        // Adicionar campos hidden para os exemplos
        $('#kt_create_team_form').append(`
            <input type="hidden" name="members[1][email]" value="ana@email.com" />
            <input type="hidden" name="members[1][exists]" value="true" />
            <input type="hidden" name="members[2][email]" value="novo@email.com" />
            <input type="hidden" name="members[2][exists]" value="false" />
        `);
        
        // Simular criação de equipe
        showNotification('Equipe criada com sucesso!', 'success');
        
        // Redirecionar para a lista de equipes
        setTimeout(() => {
            window.location.href = '{{ route("team-panel.index") }}';
        }, 1500);
    });

    // Sistema de convites para membros da equipe
    let invitedMembers = [
        // Exemplos pré-carregados (serão removidos em produção)
        {
            id: 'member_example_1',
            email: 'ana@email.com',
            exists: true,
            userData: { name: 'Ana Lima', avatar: 'assets/images/avatars/blank.png' }
        },
        {
            id: 'member_example_2',
            email: 'novo@email.com',
            exists: false,
            userData: null
        }
    ];
    let memberCounter = 2; // Começar do 3 para novos membros
    
    // Função para verificar se o usuário existe (simulação)
    function checkUserExists(email) {
        // Simulação de verificação no banco
        const existingUsers = [
            'ana@email.com',
            'carlos@email.com', 
            'mariana@email.com',
            'pedro@email.com',
            'juliana@email.com'
        ];
        
        return new Promise((resolve) => {
            setTimeout(() => {
                resolve(existingUsers.includes(email.toLowerCase()));
            }, 500);
        });
    }
    
    // Função para obter dados do usuário (simulação)
    function getUserData(email) {
        const userData = {
            'ana@email.com': { name: 'Ana Lima', avatar: 'assets/images/avatars/blank.png' },
            'carlos@email.com': { name: 'Carlos Oliveira', avatar: 'assets/images/avatars/blank.png' },
            'mariana@email.com': { name: 'Mariana Costa', avatar: 'assets/images/avatars/blank.png' },
            'pedro@email.com': { name: 'Pedro Santos', avatar: 'assets/images/avatars/blank.png' },
            'juliana@email.com': { name: 'Juliana Ferreira', avatar: 'assets/images/avatars/blank.png' }
        };
        
        return userData[email.toLowerCase()] || { name: 'Usuário não encontrado', avatar: 'assets/images/avatars/blank.png' };
    }
    
    // Função para adicionar membro à lista
    function addMemberToList(email, exists = false, userData = null) {
        memberCounter++;
        const memberId = `member_${memberCounter}`;
        
        const memberHtml = `
            <div class="card card-flush mb-4" id="${memberId}">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-50px symbol-circle me-4">
                                <img src="${userData ? userData.avatar : 'assets/images/avatars/blank.png'}" alt="Avatar" />
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-bold text-dark">${userData ? userData.name : email}</div>
                                <div class="text-muted fs-7">${email}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge ${exists ? 'badge-success' : 'badge-warning'} me-3">
                                <i class="ki-duotone ${exists ? 'ki-check-circle' : 'ki-clock'} fs-6 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                ${exists ? 'Usuário Cadastrado' : 'Convite Pendente'}
                            </span>
                            <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="removeMember('${memberId}')">
                                <i class="ki-duotone ki-trash fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#invited_members_list').append(memberHtml);
        
        // Adicionar aos dados do formulário
        invitedMembers.push({
            id: memberId,
            email: email,
            exists: exists,
            userData: userData
        });
        
        // Adicionar campos hidden ao formulário
        $('#kt_create_team_form').append(`
            <input type="hidden" name="members[${memberCounter}][email]" value="${email}" />
            <input type="hidden" name="members[${memberCounter}][exists]" value="${exists}" />
        `);
    }
    
    // Função para remover membro
    window.removeMember = function(memberId) {
        $(`#${memberId}`).remove();
        
        // Remover dos dados
        invitedMembers = invitedMembers.filter(member => member.id !== memberId);
        
        showNotification('Membro removido da lista!', 'info');
    };
    
    // Adicionar membro
    $('#add_member_btn').on('click', function() {
        const email = $('#member_email').val().trim();
        
        if (!email) {
            showNotification('Por favor, insira um email válido!', 'error');
            return;
        }
        
        // Verificar se já foi adicionado
        if (invitedMembers.some(member => member.email.toLowerCase() === email.toLowerCase())) {
            showNotification('Este email já foi adicionado à lista!', 'warning');
            return;
        }
        
        // Desabilitar botão e mostrar loading
        const $btn = $(this);
        const originalText = $btn.html();
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Verificando...');
        
        // Verificar se o usuário existe
        checkUserExists(email).then(exists => {
            const userData = exists ? getUserData(email) : null;
            
            addMemberToList(email, exists, userData);
            
            // Limpar campo
            $('#member_email').val('');
            
            // Reabilitar botão
            $btn.prop('disabled', false).html(originalText);
            
            // Mostrar notificação
            if (exists) {
                showNotification('Usuário encontrado! Será vinculado automaticamente à equipe.', 'success');
            } else {
                showNotification('Usuário não encontrado. Um convite será enviado por email.', 'info');
            }
        });
    });
    
    // Permitir adicionar com Enter
    $('#member_email').on('keypress', function(e) {
        if (e.which === 13) {
            $('#add_member_btn').click();
        }
    });

    // Formulário de edição de equipe
    $('#kt_edit_team_form').on('submit', function(e) {
        e.preventDefault();
        
        // Simular atualização de equipe
        showNotification('Equipe atualizada com sucesso!', 'success');
        
        // Redirecionar para a visualização da equipe
        setTimeout(() => {
            const teamId = '{{ $id ?? "" }}';
            if (teamId) {
                window.location.href = '{{ route("team-panel.single-team.show", ":id") }}'.replace(':id', teamId);
            }
        }, 1500);
    });

    // Ações perigosas
    $(document).on('click', '[data-kt-action="deactivate-team"]', function() {
        Swal.fire({
            title: 'Confirmar Desativação',
            text: 'Deseja desativar esta equipe? Ela ficará temporariamente indisponível.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sim, desativar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                showNotification('Equipe desativada com sucesso!', 'success');
            }
        });
    });

    $(document).on('click', '[data-kt-action="delete-team"]', function() {
        Swal.fire({
            title: 'Confirmar Exclusão',
            text: 'Esta ação é irreversível! Todos os dados da equipe serão perdidos permanentemente.',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir permanentemente!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                showNotification('Equipe excluída permanentemente!', 'success');
                // Redirecionar para a lista de equipes
                setTimeout(() => {
                    window.location.href = '{{ route("team-panel.index") }}';
                }, 1500);
            }
        });
    });
</script> 