<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyProfileUpdateRequest;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyProfileController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $supplier = $user->supplier ?? new Supplier(['user_id' => $user->id]);

        return view('pclient.company-profile.index', compact('supplier'));
    }

    public function update(CompanyProfileUpdateRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $user = auth()->user();
            $supplier = $user->supplier ?? new Supplier(['user_id' => $user->id]);

            $supplier->fill($request->validated());
            $supplier->save();

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Perfil da empresa atualizado com sucesso',
                    'supplier' => $supplier
                ]);
            }

            return redirect()->route('company-profile.index')
                ->with('success', 'Perfil da empresa atualizado com sucesso');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Erro ao atualizar perfil da empresa',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->route('company-profile.index')
                ->with('error', 'Erro ao atualizar perfil da empresa');
        }
    }
}