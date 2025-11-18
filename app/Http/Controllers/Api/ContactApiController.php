<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactApiStoreRequest;
use App\Http\Requests\Contact\ContactApiUpdateRequest;
use App\Http\Requests\Contact\TransferLeadsRequest;
use App\Http\Resources\ContactApiResource;
use App\Services\ContactService;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContactApiController extends Controller
{
    public function __construct(
        private readonly ContactService $contactService
    ) {}

    public function index(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'Usuário não autenticado',
                    'message' => 'É necessário estar autenticado para acessar contatos'
                ], 401);
            }

            $filters = $request->only([
                'search',
                'search_field',
                'status',
                'source',
                'type',
                'sort_by',
                'sort_direction',
                'date_from',
                'date_to',
                'per_page'
            ]);

            $perPage = isset($filters['per_page']) ? min((int) $filters['per_page'], 100) : 10;

            if ($user->broker) {
                $contacts = $this->contactService->getContactsByBroker($user->broker->id, $filters, $perPage);
            } elseif ($user->supplier) {
                $contacts = $this->contactService->getContactsBySupplier($user->supplier->id, $filters, $perPage);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'Permissão negada',
                    'message' => 'Usuário não possui permissão para acessar contatos'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => ContactApiResource::collection($contacts),
                'meta' => [
                    'total' => $contacts->total(),
                    'current_page' => $contacts->currentPage(),
                    'last_page' => $contacts->lastPage(),
                    'per_page' => $contacts->perPage(),
                    'from' => $contacts->firstItem(),
                    'to' => $contacts->lastItem()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Internal error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function store(ContactApiStoreRequest $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'Usuário não autenticado',
                    'message' => 'É necessário estar autenticado para criar contatos'
                ], 401);
            }

            $contact = $this->contactService->createContactForApi($request->validated(), $user);

            return response()->json([
                'success' => true,
                'message' => 'Contato criado com sucesso!',
                'data' => new ContactApiResource($contact->load(['broker', 'supplier', 'responsible', 'healthOperator']))
            ], 201);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Dados inválidos',
                'message' => $e->getMessage()
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Internal error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function show(Request $request, int $id): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'Usuário não autenticado',
                    'message' => 'É necessário estar autenticado para acessar contatos'
                ], 401);
            }

            $contact = Contact::find($id);

            if (!$contact) {
                return response()->json([
                    'success' => false,
                    'error' => 'Contato não encontrado',
                    'message' => 'O contato solicitado não foi encontrado'
                ], 404);
            }

            if (!$this->contactService->canBeAccessedBy($contact, $user)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Acesso negado',
                    'message' => 'Você não tem permissão para acessar este contato'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => new ContactApiResource($contact->load(['broker', 'supplier', 'responsible', 'healthOperator']))
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Internal error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function update(ContactApiUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'Usuário não autenticado',
                    'message' => 'É necessário estar autenticado para atualizar contatos'
                ], 401);
            }

            $contact = Contact::find($id);

            if (!$contact) {
                return response()->json([
                    'success' => false,
                    'error' => 'Contato não encontrado',
                    'message' => 'O contato solicitado não foi encontrado'
                ], 404);
            }

            if (!$this->contactService->canBeAccessedBy($contact, $user)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Acesso negado',
                    'message' => 'Você não tem permissão para atualizar este contato'
                ], 403);
            }

            $updated = $this->contactService->updateContactForApi($contact->id, $request->validated(), $user);

            if (!$updated) {
                return response()->json([
                    'success' => false,
                    'error' => 'Update error',
                    'message' => 'Unable to update contact',
                    'timestamp' => now()->toISOString()
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Contato atualizado com sucesso!',
                'data' => new ContactApiResource($updated->load(['broker', 'supplier', 'responsible', 'healthOperator']))
            ]);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Dados inválidos',
                'message' => $e->getMessage()
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Internal error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'Usuário não autenticado',
                    'message' => 'É necessário estar autenticado para excluir contatos'
                ], 401);
            }

            $contact = Contact::find($id);

            if (!$contact) {
                return response()->json([
                    'success' => false,
                    'error' => 'Contato não encontrado',
                    'message' => 'O contato solicitado não foi encontrado'
                ], 404);
            }

            if (!$this->contactService->canBeAccessedBy($contact, $user)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Acesso negado',
                    'message' => 'Você não tem permissão para excluir este contato'
                ], 403);
            }

            $deleted = $this->contactService->deleteContactForApi($contact->id, $user);

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'error' => 'Delete error',
                    'message' => 'Unable to delete contact',
                    'timestamp' => now()->toISOString()
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Contato excluído com sucesso!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Internal error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function transferLeads(TransferLeadsRequest $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'Usuário não autenticado',
                    'message' => 'É necessário estar autenticado para transferir leads'
                ], 401);
            }

            $leadIds = $request->validated()['lead_ids'];
            $reason = $request->validated()['reason'] ?? 'Transferido via API';

            $results = $this->contactService->transferLeadsToContactsForUser($leadIds, $reason, $user);

            return response()->json([
                'success' => true,
                'message' => 'Transferência de leads concluída!',
                'data' => [
                    'transferred_count' => $results['transferred_count'],
                    'failed_count' => $results['failed_count'],
                    'contacts' => ContactApiResource::collection($results['contacts']),
                    'errors' => $results['errors']
                ]
            ]);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Dados inválidos',
                'message' => $e->getMessage()
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Internal error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

}
