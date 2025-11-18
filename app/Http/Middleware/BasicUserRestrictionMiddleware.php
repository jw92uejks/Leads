<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BasicUserRestrictionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            return redirect()->route('login');
        }

        if ($user->isBasicPlan()) {
            $allowedRoutes = [
                'homepage.index',
                'dashboard',
                'funnel.index',
                'contact.index',
                'contact.create',
                'contact.ajax.index',
                'contact.store',
                'contact.show',
                'contact.edit',
                'contact.update',
                'contact.destroy',
                'contact.import.leads',
                'contact.import.bulk',
                'contact.import.leads.available',
                'contact.convert.to.lead',
                'contact.update.last.contact',
                'contact.stats',
                'marketplace.index',
                'marketplace.supplier.leads',
                'cart.index',
                'checkout.index',
                'checkout.process',
                'confirmation.index',
                'myplan.index',
                'leads.index',
                'profile.index',
                'profile.edit',
                'profile.update',
                'support.index',
                'manage-leads.index',
                'manage-leads.store',
                'manage-leads.template',
                'cart-items.index',
                'cart-items.store',
                'cart-items.delete',
            ];

            $currentRoute = $request->route()?->getName();

            if ($currentRoute && !in_array($currentRoute, $allowedRoutes)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'error' => 'Access denied',
                        'message' => 'Usuários do plano básico têm acesso limitado. Faça upgrade do seu plano para acessar todas as funcionalidades.',
                        'upgrade_required' => true
                    ], 403);
                }

                return redirect()->route('dashboard')->with('error', 'Acesso restrito. Usuários do plano básico têm acesso limitado. Faça upgrade do seu plano para acessar todas as funcionalidades.');
            }
        }

        return $next($request);
    }
}
