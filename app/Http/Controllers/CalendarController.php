<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\EventStoreRequest;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Services\EventService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

class CalendarController extends BaseController
{
    public function __construct(
        private readonly EventService $eventService
    ) {
        $this->middleware('throttle:60,1')->only(['store', 'update', 'destroy']);
        $this->middleware('throttle:120,1')->only(['events']);
    }

    public function index(): View
    {
        return view('pclient.calendar.index');
    }

    public function events(Request $request): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        if (!$request->ajax() && !$request->hasHeader('X-Requested-With') && !$request->hasHeader('Accept')) {
            abort(403, 'Direct access not allowed');
        }

        $request->validate([
            'start' => ['required', 'date'],
            'end' => ['required', 'date', 'after_or_equal:start'],
        ]);

        $start = Carbon::parse($request->input('start'));
        $end = Carbon::parse($request->input('end'));

        if ($end->diffInDays($start) > 365) {
            return response()->json([
                'success' => false,
                'message' => 'Período muito extenso. Máximo de 365 dias.',
            ], 422);
        }

        $events = $this->eventService->getEventsForFullCalendarByUser($start, $end, auth()->id());

        return response()->json($events);
    }

    public function store(EventStoreRequest $request): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        try {
            $data = $request->validated();
            $data['user_id'] = auth()->id();

            $event = $this->eventService->createEvent($data);

            return response()->json([
                'success' => true,
                'message' => 'Agendamento criado com sucesso!',
                'event' => $event,
            ], 201);
        } catch (\Exception $e) {
            \Log::error('CalendarController::store - Erro ao criar Agendamento:', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'data' => $request->validated()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor.',
            ], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        if (!request()->ajax() && !request()->hasHeader('X-Requested-With')) {
            abort(403, 'Direct access not allowed');
        }

        try {
            $event = $this->eventService->getEventByUser($id, auth()->id());

            return response()->json([
                'success' => true,
                'event' => $event,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Agendamento não encontrado.',
            ], 404);
        }
    }

    public function update(EventUpdateRequest $request, int $id): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        try {
            $event = $this->eventService->updateEventByUser($id, $request->validated(), auth()->id());

            return response()->json([
                'success' => true,
                'event' => $event,
            ]);
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('CalendarController::update - Erro ao atualizar Agendamento:', [
                'user_id' => auth()->id(),
                'event_id' => $id,
                'error' => $e->getMessage(),
                'data' => $request->validated()
            ]);

            // Return more specific error messages for certain cases
            if (str_contains($e->getMessage(), 'agendado neste horário') ||
                str_contains($e->getMessage(), 'already an event scheduled')) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            if (str_contains($e->getMessage(), 'não encontrado') ||
                str_contains($e->getMessage(), 'not found')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Agendamento não encontrado.',
                ], 404);
            }

            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor.',
            ], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        try {
            $this->eventService->deleteEventByUser($id, auth()->id());

            return response()->json([
                'success' => true,
                'message' => 'Agendamento removido com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Agendamento não encontrado.',
            ], 404);
        }
    }

    public function complete(int $id): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        try {
            $event = $this->eventService->markAsCompletedByUser($id, auth()->id());

            return response()->json([
                'success' => true,
                'message' => 'Agendamento marcado como concluído!',
                'event' => $event,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Agendamento não encontrado.',
            ], 404);
        }
    }

    public function cancel(int $id): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        try {
            $event = $this->eventService->markAsCancelledByUser($id, auth()->id());

            return response()->json([
                'success' => true,
                'message' => 'Agendamento cancelado!',
                'event' => $event,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Agendamento não encontrado.',
            ], 404);
        }
    }
}
