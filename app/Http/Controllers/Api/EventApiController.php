<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventApiStoreRequest;
use App\Http\Requests\Event\EventApiUpdateRequest;
use App\Services\EventApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
    public function __construct(
        private readonly EventApiService $eventApiService
    ) {}

    public function store(EventApiStoreRequest $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to create events'
                ], 403);
            }

            $event = $this->eventApiService->createEventForBroker($request->validated(), $user);

            return response()->json([
                'success' => true,
                'message' => 'Event created successfully',
                'data' => [
                    'event_id' => $event->id,
                    'title' => $event->title,
                    'start_date' => $event->start_date->toISOString(),
                    'end_date' => $event->end_date?->toISOString(),
                    'status' => $event->status,
                    'type' => $event->type,
                    'created_at' => $event->created_at->toISOString(),
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error creating event',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to access events'
                ], 403);
            }

            $filters = $request->only(['start_date', 'end_date', 'status', 'type', 'per_page', 'page']);
            $events = $this->eventApiService->getBrokerEvents($user, $filters);

            return response()->json([
                'success' => true,
                'data' => [
                    'events' => $events->items(),
                    'pagination' => [
                        'current_page' => $events->currentPage(),
                        'last_page' => $events->lastPage(),
                        'per_page' => $events->perPage(),
                        'total' => $events->total(),
                        'from' => $events->firstItem(),
                        'to' => $events->lastItem(),
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching events',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function show(Request $request, int $id): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to access events'
                ], 403);
            }

            $event = $this->eventApiService->getEventByBroker($id, $user);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'start_date' => $event->start_date->toISOString(),
                    'end_date' => $event->end_date?->toISOString(),
                    'all_day' => $event->all_day,
                    'color' => $event->color,
                    'status' => $event->status,
                    'type' => $event->type,
                    'location' => $event->location,
                    'attendees' => $event->attendees,
                    'metadata' => $event->metadata,
                    'created_at' => $event->created_at->toISOString(),
                    'updated_at' => $event->updated_at->toISOString(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching event',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(EventApiUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to update events'
                ], 403);
            }

            $event = $this->eventApiService->updateEventForBroker($id, $request->validated(), $user);

            return response()->json([
                'success' => true,
                'message' => 'Event updated successfully',
                'data' => [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'start_date' => $event->start_date->toISOString(),
                    'end_date' => $event->end_date?->toISOString(),
                    'all_day' => $event->all_day,
                    'color' => $event->color,
                    'status' => $event->status,
                    'type' => $event->type,
                    'location' => $event->location,
                    'attendees' => $event->attendees,
                    'metadata' => $event->metadata,
                    'updated_at' => $event->updated_at->toISOString(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error updating event',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to delete events'
                ], 403);
            }

            $this->eventApiService->deleteEventForBroker($id, $user);

            return response()->json([
                'success' => true,
                'message' => 'Event deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error deleting event',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function upcoming(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to access events'
                ], 403);
            }

            $limit = min((int) $request->get('limit', 10), 50);
            $events = $this->eventApiService->getUpcomingEventsForBroker($user, $limit);

            return response()->json([
                'success' => true,
                'data' => [
                    'events' => $events,
                    'total' => count($events)
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching upcoming events',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function markCompleted(Request $request, int $id): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to update events'
                ], 403);
            }

            $event = $this->eventApiService->markEventAsCompleted($id, $user);

            return response()->json([
                'success' => true,
                'message' => 'Event marked as completed',
                'data' => [
                    'id' => $event->id,
                    'status' => $event->status,
                    'updated_at' => $event->updated_at->toISOString(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error marking event as completed',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function markCancelled(Request $request, int $id): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to update events'
                ], 403);
            }

            $event = $this->eventApiService->markEventAsCancelled($id, $user);

            return response()->json([
                'success' => true,
                'message' => 'Event marked as cancelled',
                'data' => [
                    'id' => $event->id,
                    'status' => $event->status,
                    'updated_at' => $event->updated_at->toISOString(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error marking event as cancelled',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function today(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to access events'
                ], 403);
            }

            $events = $this->eventApiService->getBrokerTodayEvents($user);

            return response()->json([
                'success' => true,
                'data' => [
                    'events' => $events,
                    'total' => count($events),
                    'date' => now()->format('Y-m-d')
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching today events',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function weekEvents(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'Forbidden',
                    'message' => 'This user does not have permission to access events'
                ], 403);
            }

            $validated = $request->validate([
                'year' => 'required|integer|min:2020|max:2030',
                'week' => 'required|integer|min:1|max:53'
            ]);

            $events = $this->eventApiService->getWeekEvents($user, $validated['year'], $validated['week']);

            return response()->json([
                'success' => true,
                'data' => [
                    'events' => $events,
                    'total' => count($events),
                    'year' => $validated['year'],
                    'week' => $validated['week']
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation Error',
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Server Error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function monthEvents(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'Forbidden',
                    'message' => 'This user does not have permission to access events'
                ], 403);
            }

            $validated = $request->validate([
                'year' => 'required|integer|min:2020|max:2030',
                'month' => 'required|integer|min:1|max:12'
            ]);

            $events = $this->eventApiService->getMonthEvents($user, $validated['year'], $validated['month']);

            return response()->json([
                'success' => true,
                'data' => [
                    'events' => $events,
                    'total' => count($events),
                    'year' => $validated['year'],
                    'month' => $validated['month']
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation Error',
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Server Error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function searchEvents(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'Forbidden',
                    'message' => 'This user does not have permission to access events'
                ], 403);
            }

            $validated = $request->validate([
                'query' => 'required|string|min:2|max:255'
            ]);

            $events = $this->eventApiService->searchEvents($user, $validated['query']);

            return response()->json([
                'success' => true,
                'data' => [
                    'events' => $events,
                    'total' => count($events),
                    'query' => $validated['query']
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation Error',
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Server Error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function availableSlots(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to access events'
                ], 403);
            }

            $request->validate([
                'date' => 'required|date|after_or_equal:today',
                'slot_duration' => 'nullable|integer|min:15|max:240'
            ]);

            $date = \Carbon\Carbon::parse($request->date);
            $slotDuration = $request->slot_duration ?? 60;

            $slots = $this->eventApiService->getAvailableSlots($user, $date, $slotDuration);

            return response()->json([
                'success' => true,
                'data' => [
                    'available_slots' => $slots,
                    'total_slots' => count($slots),
                    'date' => $date->format('Y-m-d'),
                    'slot_duration_minutes' => $slotDuration
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching available slots',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function bulkCreate(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'success' => false,
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to create events'
                ], 403);
            }

            $request->validate([
                'events' => 'required|array|min:1|max:50',
                'events.*.title' => 'required|string|max:255',
                'events.*.start_date' => 'required|date',
                'events.*.end_date' => 'nullable|date|after_or_equal:events.*.start_date',
                'events.*.description' => 'nullable|string|max:1000',
                'events.*.type' => 'nullable|string|in:appointment,meeting,reminder,task,personal',
                'events.*.location' => 'nullable|string|max:255',
                'events.*.all_day' => 'nullable|boolean'
            ]);

            $result = $this->eventApiService->bulkCreateEvents($request->events, $user);

            return response()->json([
                'success' => true,
                'message' => 'Bulk event creation completed',
                'data' => $result
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error creating events',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }
}
