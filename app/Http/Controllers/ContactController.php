<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\ContactStoreRequest;
use App\Http\Requests\Contact\ContactUpdateRequest;
use App\Http\Requests\Contact\ContactImportRequest;
use App\Http\Resources\ContactResource;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct(
        private readonly ContactService $contactService
    ) {}

    public function index(Request $request): \Illuminate\View\View
    {
        $filters = $request->only([
            'search',
            'search_field',
            'status',
            'source',
            'sort_by',
            'sort_direction',
            'date_from',
            'date_to',
            'per_page'
        ]);

        $perPage = isset($filters['per_page']) ? (int) $filters['per_page'] : 10;
        $contacts = $this->contactService->getContacts($filters, $perPage);
        $stats = $this->contactService->getStats();

        return view('pclient.contact.index', compact('contacts', 'stats', 'filters'));
    }

    public function ajaxIndex(Request $request): JsonResponse
    {
        $key = 'contact_search_' . auth()->id();
        $maxAttempts = 60; // 60 buscas por minuto
        $decayMinutes = 1;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return response()->json([
                'success' => false,
                'message' => 'Muitas tentativas de busca. Tente novamente em alguns segundos.',
                'retry_after' => RateLimiter::availableIn($key)
            ], 429);
        }

        RateLimiter::hit($key, $decayMinutes * 60);

        $filters = $request->only([
            'search',
            'search_field',
            'status',
            'source',
            'sort_by',
            'sort_direction',
            'date_from',
            'date_to',
            'per_page',
            'page'
        ]);

        // Validação e sanitização
        $filters = $this->sanitizeFilters($filters);

        $perPage = isset($filters['per_page']) ? (int) $filters['per_page'] : 10;

        // Limitar per_page para evitar sobrecarga
        $perPage = min($perPage, 100);
        $contacts = $this->contactService->getContacts($filters, $perPage);

        $html = view('pclient.contact.partials.table-rows', compact('contacts'))->render();
        $pagination = view('pclient.contact.partials.pagination', compact('contacts'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'pagination' => $pagination,
            'total' => $contacts->total(),
            'current_page' => $contacts->currentPage(),
            'last_page' => $contacts->lastPage(),
            'per_page' => $contacts->perPage()
        ]);
    }

    private function sanitizeFilters(array $filters): array
    {
        if (isset($filters['search'])) {
            $filters['search'] = trim(strip_tags($filters['search']));
            $filters['search'] = substr($filters['search'], 0, 100);
        }

        $validSearchFields = ['', 'pj', 'pf', 'adesão'];
        if (isset($filters['search_field']) && !in_array($filters['search_field'], $validSearchFields)) {
            $filters['search_field'] = '';
        }

        $validStatuses = ['', 'active', 'inactive'];
        if (isset($filters['status']) && !in_array($filters['status'], $validStatuses)) {
            $filters['status'] = '';
        }

        $validSources = ['', 'manual', 'import', 'lead_funnel'];
        if (isset($filters['source']) && !in_array($filters['source'], $validSources)) {
            $filters['source'] = '';
        }

        // Validar campos de ordenação
        $validSortFields = ['id', 'name', 'created_at', 'city'];
        if (isset($filters['sort_by']) && !in_array($filters['sort_by'], $validSortFields)) {
            $filters['sort_by'] = 'id';
        }

        $validSortDirections = ['asc', 'desc'];
        if (isset($filters['sort_direction']) && !in_array($filters['sort_direction'], $validSortDirections)) {
            $filters['sort_direction'] = 'desc';
        }

        // Validar datas
        if (isset($filters['date_from']) && !empty($filters['date_from'])) {
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $filters['date_from'])) {
                $filters['date_from'] = '';
            }
        }

        if (isset($filters['date_to']) && !empty($filters['date_to'])) {
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $filters['date_to'])) {
                $filters['date_to'] = '';
            }
        }

        // Validar per_page
        if (isset($filters['per_page'])) {
            $filters['per_page'] = max(1, min(100, (int) $filters['per_page']));
        }

        // Validar page
        if (isset($filters['page'])) {
            $filters['page'] = max(1, (int) $filters['page']);
        }

        return $filters;
    }

    public function create()
    {
        return view('pclient.contact.modal.create');
    }

    public function store(ContactStoreRequest $request)
    {
        try {
            $contact = $this->contactService->createContact($request->validated());

            return redirect()->route('contact.index')
                ->with('success', 'Contato criado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Erro ao criar contato: ' . $e->getMessage()]);
        }
    }

    public function show(Contact $contact)
    {
        $user = auth()->user();

        if (!$this->contactService->canBeAccessedBy($contact, $user)) {
            abort(403, 'Acesso negado');
        }

        $contact->load(['broker', 'supplier', 'responsible', 'healthOperator']);

        return response()->json([
            'success' => true,
            'data' => new ContactResource($contact)
        ]);
    }

    public function edit(Contact $contact)
    {
        $user = auth()->user();

        if (!$this->contactService->canBeAccessedBy($contact, $user)) {
            abort(403, 'Acesso negado');
        }

        $contact->load(['broker', 'supplier', 'responsible', 'healthOperator']);

        return view('pclient.contact.modal.edit', compact('contact'));
    }

    public function update(ContactUpdateRequest $request, $id)
    {
        $user = auth()->user();
        $contact = Contact::find($id);

        if (!$contact) {
            abort(404, 'Contato não encontrado');
        }

        if (!$this->contactService->canBeAccessedBy($contact, $user)) {
            abort(403, 'Acesso negado');
        }

        try {
            $updated = $this->contactService->updateContact($contact->id, $request->validated());

            if ($updated) {
                $message = 'Contato atualizado com sucesso!';

                // Se veio de um modal, redirecionar para a página principal
                if ($request->has('close_modal')) {
                    return redirect()->route('contact.index')->with('success', $message);
                }

                // Se não veio de modal, voltar para a página anterior
                return redirect()->back()->with('success', $message);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Erro ao atualizar contato']);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Erro ao atualizar contato: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $contact = Contact::find($id);

        if (!$contact) {
            return redirect()->route('contact.index')->withErrors(['error' => 'Contato não encontrado']);
        }

        if (!$this->contactService->canBeAccessedBy($contact, $user)) {
            return redirect()->route('contact.index')->withErrors(['error' => 'Acesso negado']);
        }

        try {
            $deleted = $this->contactService->deleteContact($contact->id);

            if ($deleted) {
                return redirect()->route('contact.index')->with('success', 'Contato excluído com sucesso!');
            }

            return redirect()->route('contact.index')->withErrors(['error' => 'Erro ao excluir contato']);

        } catch (\Exception $e) {
            return redirect()->route('contact.index')->withErrors(['error' => 'Erro ao excluir contato: ' . $e->getMessage()]);
        }
    }

    public function importFromLeads(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();
            $brokerId = $user->broker?->id;
            $supplierId = $user->supplier?->id;

            if (!$brokerId && !$supplierId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário não possui permissão para importar contatos'
                ], 403);
            }

            $leadIds = $request->input('lead_ids', []);
            $imported = $this->contactService->importFromLeads($leadIds, $brokerId, $supplierId);

            return response()->json([
                'success' => true,
                'message' => "{$imported} contatos importados com sucesso",
                'data' => [
                    'imported_count' => $imported
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao importar contatos: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkImport(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();
            $brokerId = $user->broker?->id;
            $supplierId = $user->supplier?->id;

            if (!$brokerId && !$supplierId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário não possui permissão para importar contatos'
                ], 403);
            }

            $contacts = $request->input('contacts', []);
            $imported = $this->contactService->bulkImport($contacts, $brokerId, $supplierId);

            return response()->json([
                'success' => true,
                'message' => "{$imported} contatos importados com sucesso",
                'data' => [
                    'imported_count' => $imported
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao importar contatos: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getLeadsForImport(): JsonResponse
    {
        try {
            $user = auth()->user();
            $brokerId = $user->broker?->id;
            $supplierId = $user->supplier?->id;

            if (!$brokerId && !$supplierId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário não possui permissão para acessar leads'
                ], 403);
            }

            $leads = $this->contactService->getLeadsForImport($brokerId, $supplierId);

            $formattedLeads = $leads->map(function ($lead) {
                return [
                    'id' => $lead->id,
                    'name' => $lead->name ?? $lead->corporateName,
                    'email' => $lead->email,
                    'phone' => $lead->phone,
                    'company' => $lead->corporateName,
                    'city' => $lead->city,
                    'state' => $lead->state,
                    'status' => $lead->status?->label(),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedLeads
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar leads: ' . $e->getMessage()
            ], 500);
        }
    }

    public function convertToLead(Request $request, Contact $contact): JsonResponse
    {
        $user = auth()->user();

        if (!$this->contactService->canBeAccessedBy($contact, $user)) {
            abort(403, 'Acesso negado');
        }

        try {
            $converted = $this->contactService->convertToLead($contact->id, $request->input('reason'));

            if ($converted) {
                $contact->refresh();

                return response()->json([
                    'success' => true,
                    'message' => 'Contato convertido para lead com sucesso',
                    'data' => [
                        'converted_at' => $contact->converted_at?->format('d/m/Y H:i'),
                        'conversion_reason' => $contact->conversion_reason
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Erro ao converter contato para lead'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao converter contato para lead: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateLastContact(Request $request, Contact $contact): JsonResponse
    {
        $user = auth()->user();

        if (!$this->contactService->canBeAccessedBy($contact, $user)) {
            abort(403, 'Acesso negado');
        }

        try {
            $updated = $this->contactService->updateLastContact($contact->id);

            if ($updated) {
                $contact->refresh();

                return response()->json([
                    'success' => true,
                    'message' => 'Data do último contato atualizada',
                    'data' => [
                        'last_contact_at' => $contact->last_contact_at?->format('d/m/Y H:i')
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar data do último contato'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar data do último contato: ' . $e->getMessage()
            ], 500);
        }
    }

    public function stats(): JsonResponse
    {
        try {
            $user = auth()->user();
            $brokerId = $user->broker?->id;
            $supplierId = $user->supplier?->id;

            if (!$brokerId && !$supplierId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário não possui permissão para acessar estatísticas'
                ], 403);
            }

            $stats = $this->contactService->getStats($brokerId, $supplierId);

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar estatísticas: ' . $e->getMessage()
            ], 500);
        }
    }

    public function convertLeadToContact(Request $request): JsonResponse
    {
        $request->validate([
            'lead_id' => 'required|integer|exists:leads,id',
            'reason' => 'nullable|string|max:255'
        ]);

        try {
            $contact = $this->contactService->convertLeadToContact(
                $request->lead_id,
                $request->reason ?? 'Transferido'
            );

            return response()->json([
                'success' => true,
                'message' => 'Lead convertido para contato com sucesso!',
                'data' => new ContactResource($contact)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao converter lead para contato: ' . $e->getMessage()
            ], 500);
        }
    }
}
