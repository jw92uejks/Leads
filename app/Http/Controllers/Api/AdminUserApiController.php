<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $query = User::with(['broker.subscription', 'supplier']);

            if ($request->has('search')) {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%")
                      ->orWhere('email', 'like', "%{$searchTerm}%")
                      ->orWhere('phone', 'like', "%{$searchTerm}%")
                      ->orWhere('ucode', 'like', "%{$searchTerm}%");
                });
            }

            if ($request->has('name')) {
                $query->where('name', 'like', "%{$request->name}%");
            }

            if ($request->has('phone')) {
                $query->where('phone', 'like', "%{$request->phone}%");
            }

            if ($request->has('ucode')) {
                $query->where('ucode', 'like', "%{$request->ucode}%");
            }

            if ($request->has('email')) {
                $query->where('email', 'like', "%{$request->email}%");
            }

            if ($request->has('status')) {
                $status = $request->status;
                if ($status === 'active') {
                    $query->whereNotNull('email_verified_at');
                } elseif ($status === 'inactive') {
                    $query->whereNull('email_verified_at');
                }
            }

            if ($request->has('plan_type')) {
                $planType = $request->plan_type;

                if ($planType === 'free') {
                    $query->whereDoesntHave('broker', function ($q) {
                        $q->whereNotNull('subscription_id')
                          ->where('subscription_expires_at', '>', now());
                    });
                } else {
                    $query->whereHas('broker.subscription', function ($q) use ($planType) {
                        $q->where('plan_type', $planType);
                    })->whereHas('broker', function ($q) {
                        $q->where('subscription_expires_at', '>', now());
                    });
                }
            }

            if ($request->has('has_subscription')) {
                $hasSubscription = filter_var($request->has_subscription, FILTER_VALIDATE_BOOLEAN);

                if ($hasSubscription) {
                    $query->whereHas('broker', function ($q) {
                        $q->whereNotNull('subscription_id')
                          ->where('subscription_expires_at', '>', now());
                    });
                } else {
                    $query->whereDoesntHave('broker', function ($q) {
                        $q->whereNotNull('subscription_id')
                          ->where('subscription_expires_at', '>', now());
                    });
                }
            }

            if ($request->has('subscription_id')) {
                $query->whereHas('broker', function ($q) use ($request) {
                    $q->where('subscription_id', $request->subscription_id)
                      ->where('subscription_expires_at', '>', now());
                });
            }

            if ($request->has('expires_before')) {
                $query->whereHas('broker', function ($q) use ($request) {
                    $q->whereNotNull('subscription_expires_at')
                      ->where('subscription_expires_at', '<', $request->expires_before);
                });
            }

            if ($request->has('expires_after')) {
                $query->whereHas('broker', function ($q) use ($request) {
                    $q->whereNotNull('subscription_expires_at')
                      ->where('subscription_expires_at', '>', $request->expires_after);
                });
            }

            if ($request->has('subscription_status')) {
                $status = $request->subscription_status;

                if ($status === 'active') {
                    $query->whereHas('broker', function ($q) {
                        $q->whereNotNull('subscription_id')
                          ->where('subscription_expires_at', '>', now());
                    });
                } elseif ($status === 'expired') {
                    $query->whereHas('broker', function ($q) {
                        $q->whereNotNull('subscription_id')
                          ->where('subscription_expires_at', '<=', now());
                    });
                } elseif ($status === 'never_subscribed') {
                    $query->whereHas('broker', function ($q) {
                        $q->whereNull('subscription_id');
                    });
                }
            }

            $perPage = min($request->get('per_page', 15), 100);
            $users = $query->orderBy('created_at', 'desc')->paginate($perPage);

            $usersData = $users->items();
            $formattedUsers = collect($usersData)->map(function ($user) {
                return [
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'ucode' => $user->ucode,
                    'selected_menu' => $user->selected_menu,
                    'current_state' => $user->current_state,
                    'created_at' => $user->created_at,
                    'is_verified' => !is_null($user->email_verified_at),
                    'broker' => $user->broker ? [
                        'id' => $user->broker->id,
                        'user_id' => $user->broker->user_id,
                        'subscription_id' => $user->broker->subscription_id,
                        'plan_type' => $user->broker->plan_type?->value ?? 0,
                        'is_active' => $user->broker->is_active,
                        'subscription_expires_at' => $user->broker->subscription_expires_at,
                        'has_active_subscription' => $user->hasActiveSubscription(),
                        'created_at' => $user->broker->created_at,
                        'updated_at' => $user->broker->updated_at,
                    ] : null,
                    'supplier' => $user->supplier ? [
                        'name' => $user->supplier->name,
                        'cnpj' => $user->supplier->cnpj,
                        'status' => $user->supplier->status->value
                    ] : null
                ];
            });

            $appliedFilters = array_filter([
                'search' => $request->get('search'),
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'ucode' => $request->get('ucode'),
                'email' => $request->get('email'),
                'status' => $request->get('status')
            ], function($value) {
                return !is_null($value) && $value !== '';
            });

            return response()->json([
                'success' => true,
                'data' => $formattedUsers,
                'meta' => [
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                    'per_page' => $users->perPage(),
                    'total' => $users->total(),
                    'from' => $users->firstItem(),
                    'to' => $users->lastItem()
                ],
                'filters' => $appliedFilters
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching users',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function show(User $user): JsonResponse
    {
        try {
            $user->load(['broker.subscription', 'supplier']);

            return response()->json([
                'success' => true,
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'ucode' => $user->ucode,
                    'selected_menu' => $user->selected_menu,
                    'current_state' => $user->current_state,
                    'created_at' => $user->created_at,
                    'is_verified' => !is_null($user->email_verified_at),
                    'broker' => $user->broker ? [
                        'id' => $user->broker->id,
                        'user_id' => $user->broker->user_id,
                        'subscription_id' => $user->broker->subscription_id,
                        'plan_type' => $user->broker->plan_type?->value ?? 0,
                        'is_active' => $user->broker->is_active,
                        'subscription_expires_at' => $user->broker->subscription_expires_at,
                        'has_active_subscription' => $user->hasActiveSubscription(),
                        'created_at' => $user->broker->created_at,
                        'updated_at' => $user->broker->updated_at,
                        'subscription' => $user->broker->subscription ? [
                            'id' => $user->broker->subscription->id,
                            'name' => $user->broker->subscription->name,
                            'description' => $user->broker->subscription->description,
                            'price' => $user->broker->subscription->price,
                            'plan_type' => $user->broker->subscription->plan_type,
                            'duration_days' => $user->broker->subscription->durationDays,
                            'is_active' => $user->broker->subscription->isActive,
                            'features' => $user->broker->subscription->features,
                            'max_team_members' => $user->broker->subscription->max_team_members,
                            'has_team_access' => $user->broker->subscription->has_team_access,
                            'has_enterprise_access' => $user->broker->subscription->has_enterprise_access,
                            'stripe_product_id' => $user->broker->subscription->stripe_product_id,
                            'stripe_price_id' => $user->broker->subscription->stripe_price_id,
                            'last_synced_at' => $user->broker->subscription->last_synced_at,
                            'created_at' => $user->broker->subscription->created_at,
                            'updated_at' => $user->broker->subscription->updated_at,
                        ] : null
                    ] : null,
                    'supplier' => $user->supplier ? [
                        'name' => $user->supplier->name,
                        'cnpj' => $user->supplier->cnpj,
                        'status' => $user->supplier->status->value
                    ] : null
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching user',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }


    public function updateState(Request $request, User $user): JsonResponse
    {
        try {
            $validated = $request->validate([
                'selected_menu' => ['nullable', 'integer', 'min:1', 'max:2147483647'],
                'current_state' => ['nullable', 'string', 'max:255'],
            ]);

            $user->update(array_filter($validated, fn($value) => !is_null($value)));

            return response()->json([
                'success' => true,
                'message' => 'User state updated successfully',
                'data' => [
                    'id' => $user->id,
                    'selected_menu' => $user->selected_menu,
                    'current_state' => $user->current_state,
                    'updated_at' => $user->updated_at,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error updating user state',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function updateStateByPhone(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'phone' => ['required', 'string'],
                'selected_menu' => ['nullable', 'integer', 'min:1', 'max:2147483647'],
                'current_state' => ['nullable', 'string', 'max:255'],
            ]);

            $cleanPhone = \App\Helpers\PhoneHelper::cleanPhone($validated['phone']);

            $user = User::where('phone', $cleanPhone)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'User not found',
                    'message' => 'User not found with this phone number',
                    'timestamp' => now()->toISOString()
                ], 404);
            }

            $dataToUpdate = array_filter([
                'selected_menu' => $validated['selected_menu'] ?? null,
                'current_state' => $validated['current_state'] ?? null,
            ], fn($value) => !is_null($value));

            $user->update($dataToUpdate);

            return response()->json([
                'success' => true,
                'message' => 'User state updated successfully by phone',
                'data' => [
                    'id' => $user->id,
                    'phone' => $user->phone,
                    'selected_menu' => $user->selected_menu,
                    'current_state' => $user->current_state,
                    'updated_at' => $user->updated_at,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error updating user state by phone',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function stats(): JsonResponse
    {
        try {
            $totalUsers = User::count();
            $verifiedUsers = User::whereNotNull('email_verified_at')->count();
            $unverifiedUsers = $totalUsers - $verifiedUsers;

            $recentUsers = User::where('created_at', '>=', now()->subDays(30))->count();

            $brokersCount = User::whereHas('broker')->count();
            $suppliersCount = User::whereHas('supplier')->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'total_users' => $totalUsers,
                    'verified_users' => $verifiedUsers,
                    'unverified_users' => $unverifiedUsers,
                    'verification_rate' => $totalUsers > 0 ? round(($verifiedUsers / $totalUsers) * 100, 2) : 0,
                    'recent_users_30_days' => $recentUsers,
                    'brokers_count' => $brokersCount,
                    'suppliers_count' => $suppliersCount,
                ],
                'generated_at' => now()->toISOString()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching statistics',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

}
