<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rotas de exemplo para o sistema de pagamentos
Route::prefix('payment-example')->group(function () {
    Route::get('/gateway', [App\Http\Controllers\PaymentExampleController::class, 'showCurrentGateway']);
    Route::post('/switch-gateway', [App\Http\Controllers\PaymentExampleController::class, 'switchGateway']);
    Route::post('/create-test-payment', [App\Http\Controllers\PaymentExampleController::class, 'createTestPayment']);
    Route::get('/payment-status', [App\Http\Controllers\PaymentExampleController::class, 'getPaymentStatus']);
});

Route::middleware('auth')->group(function () {
    Route::prefix('homepage')->group(function () {
        Route::get('/', [App\Http\Controllers\MenuController::class, 'index'])->name('homepage.index');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    });

    Route::prefix('supplier-dashboard')->middleware('basic.restriction')->group(function () {
        Route::get('/', [App\Http\Controllers\SupplierDashboardController::class, 'index'])->name('supplier-dashboard.index');
    });

    Route::prefix('funnel')->group(function () {
        Route::get('/', [App\Http\Controllers\FunnelController::class, 'index'])->name('funnel.index');
    });

    Route::prefix('connect')->middleware('basic.restriction')->group(function () {
        Route::get('/', [App\Http\Controllers\ConnectController::class, 'index'])->name('connect.index');
        Route::get('/create', [App\Http\Controllers\ConnectController::class, 'create'])->name('connect.create');
        Route::get('/{instance}/edit', [App\Http\Controllers\ConnectController::class, 'edit'])->name('connect.edit');
    });

    Route::prefix('calendar')->middleware('basic.restriction')->group(function () {
        Route::get('/', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar.index');
        Route::get('/events', [App\Http\Controllers\CalendarController::class, 'events'])->name('calendar.events');
        Route::post('/events', [App\Http\Controllers\CalendarController::class, 'store'])->name('calendar.store');
        Route::get('/events/{id}', [App\Http\Controllers\CalendarController::class, 'show'])->name('calendar.show');
        Route::put('/events/{id}', [App\Http\Controllers\CalendarController::class, 'update'])->name('calendar.update');
        Route::delete('/events/{id}', [App\Http\Controllers\CalendarController::class, 'destroy'])->name('calendar.destroy');
        Route::patch('/events/{id}/complete', [App\Http\Controllers\CalendarController::class, 'complete'])->name('calendar.complete');
        Route::patch('/events/{id}/cancel', [App\Http\Controllers\CalendarController::class, 'cancel'])->name('calendar.cancel');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
    });

    Route::prefix('contact')->group(function () {
        Route::get('/', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
        Route::get('/create', [App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
        Route::get('/ajax', [App\Http\Controllers\ContactController::class, 'ajaxIndex'])->name('contact.ajax.index')->middleware('throttle:60,1');
        Route::post('/', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
        Route::get('/{id}', [App\Http\Controllers\ContactController::class, 'show'])->name('contact.show');
        Route::get('/{id}/edit', [App\Http\Controllers\ContactController::class, 'edit'])->name('contact.edit');
        Route::post('/{id}/edit', [App\Http\Controllers\ContactController::class, 'update'])->name('contact.update');
        // Route::put('/{id}/edit', [App\Http\Controllers\ContactController::class, 'update'])->name('contact.update');
        Route::delete('/{id}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('contact.destroy');
        Route::post('/import/leads', [App\Http\Controllers\ContactController::class, 'importFromLeads'])->name('contact.import.leads');
        Route::post('/import/bulk', [App\Http\Controllers\ContactController::class, 'bulkImport'])->name('contact.import.bulk');
        Route::get('/import/leads/available', [App\Http\Controllers\ContactController::class, 'getLeadsForImport'])->name('contact.import.leads.available');
        Route::post('/{id}/convert-to-lead', [App\Http\Controllers\ContactController::class, 'convertToLead'])->name('contact.convert.to.lead');
        Route::put('/{id}/last-contact', [App\Http\Controllers\ContactController::class, 'updateLastContact'])->name('contact.update.last.contact');
        Route::get('/stats/overview', [App\Http\Controllers\ContactController::class, 'getStats'])->name('contact.stats');
    });

    Route::prefix('marketplace')->group(function () {
        Route::get('/', [App\Http\Controllers\MarketplaceController::class, 'index'])->name('marketplace.index');
        Route::get('/supplier/{id}/leads', [App\Http\Controllers\MarketplaceController::class, 'supplierLeads'])->name('marketplace.supplier.leads');
    });

    Route::prefix('cart')->group(function () {
        Route::get('/', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    });

    Route::prefix('checkout')->group(function () {
        Route::get('/', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    });

    Route::prefix('confirmation')->group(function () {
        Route::get('/', [App\Http\Controllers\ConfirmationController::class, 'index'])->name('confirmation.index');
    });

    Route::prefix('transactions')->group(function () {
        Route::get('/', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
    });

    Route::prefix('myplan')->group(function () {
        Route::get('/', [App\Http\Controllers\MyplanController::class, 'index'])->name('myplan.index');
    });

    Route::prefix('leads')->group(function () {
        Route::get('/', [App\Http\Controllers\LeadsController::class, 'index'])->name('leads.index');
    });

    Route::prefix('access')->middleware('basic.restriction')->group(function () {
        Route::get('/config/access-control', [App\Http\Controllers\AccessControlController::class, 'index'])->name('access.index');
    });

    Route::prefix('config')->middleware('basic.restriction')->group(function () {
        Route::get('/', [App\Http\Controllers\ConfigController::class, 'index'])->name('config.index');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
        Route::get('/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/edit', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::get('/whatsapp-security', [App\Http\Controllers\ProfileController::class, 'showWhatsAppSecurity'])->name('profile.whatsapp-security');
        Route::post('/whatsapp-security/reset', [App\Http\Controllers\ProfileController::class, 'resetWhatsAppVerification'])->name('profile.whatsapp-security.reset');
        Route::post('/whatsapp-security/authorize-device', [App\Http\Controllers\ProfileController::class, 'authorizeNewDevice'])->name('profile.whatsapp-security.authorize-device');
        Route::post('/whatsapp-security/toggle-multiple-devices', [App\Http\Controllers\ProfileController::class, 'toggleMultipleDevices'])->name('profile.whatsapp-security.toggle-multiple-devices');
    });

    Route::prefix('financial')->middleware('basic.restriction')->group(function () {
        Route::get('/', [App\Http\Controllers\FinancialController::class, 'index'])->name('financial.index');
    });

    Route::prefix('pricing')->group(function () {
        Route::get('/', [App\Http\Controllers\PricingController::class, 'index'])->name('pricing.index');
        Route::get('/select/{subscriptionId}', [App\Http\Controllers\PricingController::class, 'selectPlan'])->name('pricing.select');
    });

    Route::prefix('support')->group(function () {
        Route::get('/', [App\Http\Controllers\SupportController::class, 'index'])->name('support.index');
    });

    Route::prefix('admin')->middleware('basic.restriction')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.index');
    });

    Route::prefix('api-leads')->middleware('basic.restriction')->group(function () {
        Route::get('/', [App\Http\Controllers\ApiLeadsController::class, 'index'])->name('api-leads.index');
    });

    Route::prefix('brokers')->middleware(['broker', 'basic.restriction'])->group(function () {
        Route::get('/', [App\Http\Controllers\BrokerController::class, 'index'])->name('brokers.index');
        Route::get('/{id}', [App\Http\Controllers\BrokerController::class, 'show'])->name('brokers.show');
        Route::put('/{brokerId}/subscription', [App\Http\Controllers\BrokerController::class, 'updateSubscription'])->name('brokers.update-subscription');
        Route::delete('/{id}', [App\Http\Controllers\BrokerController::class, 'destroy'])->name('brokers.destroy');
    });

    Route::prefix('manage-leads')->group(function () {
        Route::get('/', [App\Http\Controllers\ManageLeadsController::class, 'index'])->name('manage-leads.index');
        Route::post('/', [App\Http\Controllers\ManageLeadsController::class, 'store'])->name('manage-leads.store');
        Route::get('/download-template', [App\Http\Controllers\ManageLeadsController::class, 'uploadTemplate'])->name('manage-leads.template');
    });

    Route::prefix('subscriptions')->name('subscriptions.')->group(function () {
        Route::get('/', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('index');
        Route::post('/create-payment-link', [App\Http\Controllers\SubscriptionController::class, 'createPaymentLink'])->name('create-payment-link');
        Route::get('/success', [App\Http\Controllers\SubscriptionController::class, 'success'])->name('success');
    });

    Route::prefix('team-panel')->middleware(['broker', 'basic.restriction', 'subscription.access:team_panel'])->group(function () {
        Route::get('/', [App\Http\Controllers\TeamPanelController::class, 'index'])->name('team-panel.index');
        Route::get('/team/{id}', [App\Http\Controllers\TeamPanelController::class, 'show'])->name('team-panel.single-team.show');
        Route::get('/team/{id}/edit', [App\Http\Controllers\TeamPanelController::class, 'edit'])->name('team-panel.single-team.edit');
        Route::get('/team/{id}/members', [App\Http\Controllers\TeamPanelController::class, 'members'])->name('team-panel.single-team.members');
        Route::get('/team/{id}/access', [App\Http\Controllers\TeamPanelController::class, 'access'])->name('team-panel.single-team.access');
        Route::get('/team/{id}/transfer', [App\Http\Controllers\TeamPanelController::class, 'transfer'])->name('team-panel.single-team.transfer');
        Route::post('/team/{id}/transfer-bulk', [App\Http\Controllers\TeamPanelController::class, 'transferBulk'])->name('team-panel.transfer-bulk');
        Route::post('/team/{id}/transfer-single', [App\Http\Controllers\TeamPanelController::class, 'transferSingle'])->name('team-panel.transfer-single');
        Route::get('/create', [App\Http\Controllers\TeamPanelController::class, 'create'])->name('team-panel.single-team.create');
    });

    Route::prefix('company-profile')->middleware('basic.restriction')->group(function () {
        Route::get('/', [App\Http\Controllers\CompanyProfileController::class, 'index'])->name('company-profile.index');
        Route::get('/edit', [App\Http\Controllers\CompanyProfileController::class, 'edit'])->name('company-profile.edit');
        Route::put('/', [App\Http\Controllers\CompanyProfileController::class, 'update'])->name('company-profile.update');
    });

    Route::prefix('contestation')->middleware('basic.restriction')->group(function () {
        Route::get('/', [App\Http\Controllers\ContestationController::class, 'index'])->name('contestation.index');
    });

    Route::prefix('cart-items')->group(function () {
        Route::get('/', [\App\Http\Controllers\CartItemController::class, 'index'])->name('cart-items.index');
        Route::post('/', [\App\Http\Controllers\CartItemController::class, 'store'])->name('cart-items.store');
        Route::delete('/{lead}', [\App\Http\Controllers\CartItemController::class, 'delete'])->name('cart-items.delete');
    });
});

// Stripe Webhook
Route::post('/stripe/webhook', [App\Http\Controllers\StripeWebhookController::class, 'handleWebhook']);

Route::prefix('whatsapp')->group(function () {
    Route::get('/verify-phone', [App\Http\Controllers\WhatsAppPhoneVerificationController::class, 'show'])->name('whatsapp.verify-phone.show');
    Route::post('/verify-phone', [App\Http\Controllers\WhatsAppPhoneVerificationController::class, 'verify'])->name('whatsapp.verify-phone');
    Route::get('/blocked', function () {return view('mobile.whatsapp.blocked');})->name('whatsapp.blocked');
    Route::get('/leads', [App\Http\Controllers\WhatsAppLeadController::class, 'index'])->middleware(['whatsapp.token', 'whatsapp.verified', 'whatsapp.not.blocked'])->name('whatsapp.leads');
    Route::get('/leads/create', [App\Http\Controllers\WhatsAppLeadController::class, 'create'])->middleware(['whatsapp.token', 'whatsapp.verified', 'whatsapp.not.blocked'])->name('whatsapp.leads.create');
});

require __DIR__.'/auth.php';
// Removido: rotas do Kanban