<?php

use Illuminate\Support\Facades\Route;

Route::get('/up', [App\Http\Controllers\HealthController::class, 'status'])
    ->middleware(['throttle:60,1'])
    ->name('api.health.status');

// Removido: rotas relacionadas ao Kanban

Route::prefix('v1')
    ->middleware(['ucode.auth', 'force.json', 'throttle:100,1'])
    ->group(function () {
        Route::prefix('leads')->group(function () {
            Route::get('search/phone', [App\Http\Controllers\Api\LeadApiController::class, 'searchByPhone'])->name('api.v1.leads.search.phone');
            Route::get('search/name', [App\Http\Controllers\Api\LeadApiController::class, 'searchByName'])->name('api.v1.leads.search.name');
            Route::get('search/email', [App\Http\Controllers\Api\LeadApiController::class, 'searchByEmail'])->name('api.v1.leads.search.email');
            Route::get('search/is_automation', [App\Http\Controllers\Api\LeadApiController::class, 'byIsAutomation'])->name('api.v1.leads.search.is-automation');
            Route::get('step', [App\Http\Controllers\Api\LeadApiController::class, 'byStep'])->name('api.v1.leads.by-step');
            Route::get('by-owner', [App\Http\Controllers\Api\LeadTransferController::class, 'getLeadsByOwner'])->name('api.v1.leads.by-owner');
            Route::get('by-responsible', [App\Http\Controllers\Api\LeadTransferController::class, 'getLeadsByResponsible'])->name('api.v1.leads.by-responsible');
            Route::put('{leadId}/transfer-ownership', [App\Http\Controllers\Api\LeadTransferController::class, 'transferOwnership'])->name('api.v1.leads.transfer-ownership');
            Route::put('{leadId}/delegate-responsibility', [App\Http\Controllers\Api\LeadTransferController::class, 'delegateResponsibility'])->name('api.v1.leads.delegate-responsibility');
            Route::post('transfer-bulk', [App\Http\Controllers\Api\LeadTransferController::class, 'transferBulk'])->name('api.v1.leads.transfer-bulk');
        });

        Route::apiResource('leads', App\Http\Controllers\Api\LeadApiController::class)->names('api.v1.leads');

        Route::get('events/upcoming', [App\Http\Controllers\Api\EventApiController::class, 'upcoming'])->name('api.v1.events.upcoming');
        Route::get('events/today', [App\Http\Controllers\Api\EventApiController::class, 'today'])->name('api.v1.events.today');
        Route::put('events/{id}/complete', [App\Http\Controllers\Api\EventApiController::class, 'markCompleted'])->name('api.v1.events.complete');
        Route::put('events/{id}/cancel', [App\Http\Controllers\Api\EventApiController::class, 'markCancelled'])->name('api.v1.events.cancel');
        Route::apiResource('events', App\Http\Controllers\Api\EventApiController::class)->names('api.v1.events');

        Route::get('calendar/week', [App\Http\Controllers\Api\EventApiController::class, 'weekEvents'])->name('api.v1.calendar.week');
        Route::get('calendar/month', [App\Http\Controllers\Api\EventApiController::class, 'monthEvents'])->name('api.v1.calendar.month');
        Route::get('calendar/search', [App\Http\Controllers\Api\EventApiController::class, 'searchEvents'])->name('api.v1.calendar.search');
        Route::get('calendar/available-slots', [App\Http\Controllers\Api\EventApiController::class, 'availableSlots'])->name('api.v1.calendar.available-slots');
        Route::post('calendar/bulk', [App\Http\Controllers\Api\EventApiController::class, 'bulkCreate'])->name('api.v1.calendar.bulk');

        Route::apiResource('contacts', App\Http\Controllers\Api\ContactApiController::class)->names('api.v1.contacts');

        Route::prefix('contacts')->group(function () {
            Route::post('transfer-leads', [App\Http\Controllers\Api\ContactApiController::class, 'transferLeads'])->name('api.v1.contacts.transfer-leads');
        });

        Route::apiResource('automations', App\Http\Controllers\Api\LeadAutomationApiController::class)->names('api.v1.automations');

        Route::prefix('automations')->group(function () {
            Route::get('lead/{leadId}', [App\Http\Controllers\Api\LeadAutomationApiController::class, 'byLead'])->name('api.v1.automations.by-lead');
            Route::get('status', [App\Http\Controllers\Api\LeadAutomationApiController::class, 'byStatus'])->name('api.v1.automations.by-status');
            Route::get('search/phone', [App\Http\Controllers\Api\LeadAutomationApiController::class, 'searchByPhone'])->name('api.v1.automations.search.phone');
            Route::get('search/name', [App\Http\Controllers\Api\LeadAutomationApiController::class, 'searchByName'])->name('api.v1.automations.search.name');
            Route::get('renewals/upcoming', [App\Http\Controllers\Api\LeadAutomationApiController::class, 'upcomingRenewals'])->name('api.v1.automations.renewals.upcoming');
            Route::get('payments/upcoming', [App\Http\Controllers\Api\LeadAutomationApiController::class, 'upcomingPayments'])->name('api.v1.automations.payments.upcoming');
            Route::get('birthdays/month', [App\Http\Controllers\Api\LeadAutomationApiController::class, 'birthdaysInMonth'])->name('api.v1.automations.birthdays.month');
            Route::get('contacts/due', [App\Http\Controllers\Api\LeadAutomationApiController::class, 'periodicContactsDue'])->name('api.v1.automations.contacts.due');
        });

        Route::get('health-operators', [App\Http\Controllers\Api\HealthOperatorApiController::class, 'index'])->name('api.v1.health-operators.index');
    });

Route::prefix('v2/supplier')
    ->middleware(['supplier.auth', 'force.json', 'throttle:100,1'])
    ->group(function () {
        Route::apiResource('leads', App\Http\Controllers\Api\SupplierLeadApiController::class)->names('api.v2.supplier.leads');
    });

Route::prefix('v3/admin')
    ->middleware(['admin.api.auth', 'force.json', 'throttle:60,1'])
    ->group(function () {
        Route::get('users', [App\Http\Controllers\Api\AdminUserApiController::class, 'index'])->name('api.v3.admin.users.index');
        Route::get('users/stats', [App\Http\Controllers\Api\AdminUserApiController::class, 'stats'])->name('api.v3.admin.users.stats');
        Route::get('users/{user}', [App\Http\Controllers\Api\AdminUserApiController::class, 'show'])->name('api.v3.admin.users.show');
        Route::patch('users/{user}/state', [App\Http\Controllers\Api\AdminUserApiController::class, 'updateState'])->name('api.v3.admin.users.update-state');
        Route::patch('users/state/byphone', [App\Http\Controllers\Api\AdminUserApiController::class, 'updateStateByPhone'])->name('api.v3.admin.users.update-state-byphone');
    });

Route::post('whatsapp/generate-token', [App\Http\Controllers\WhatsAppAuthController::class, 'generateToken'])
    ->middleware(['admin.api.auth', 'throttle:10,1', 'force.json'])
    ->name('api.whatsapp.generate-token');

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'force.json', 'throttle:100,1'])
    ->group(function () {
        Route::apiResource('leads', App\Http\Controllers\Api\LeadApiController::class)->only(['index', 'store']);
    });


