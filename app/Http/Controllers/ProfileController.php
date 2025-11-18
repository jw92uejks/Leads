<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorizeDeviceRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\WhatsAppResetVerificationRequest;
use App\Services\UserService;
use App\Services\WhatsAppSecurityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile information.
     */
    public function index(Request $request): View {
        return view('pclient.profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View {
        return view('pclient.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, UserService $userService): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        $cpf = $validated['cpf'] ?? null;
        if ($cpf) {
            $cpf = preg_replace('/\D/', '', $cpf);
        }

        $cnpj = $validated['cnpj'] ?? null;
        if ($cnpj) {
            $cnpj = preg_replace('/\D/', '', $cnpj);
        }

        $phone = $validated['phone'] ?? null;
        if ($phone) {
            $phone = preg_replace('/\D/', '', $phone);
        }

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $phone,
            'cpf' => $cpf,
            'cnpj' => $cnpj,
            'type' => $validated['type'] ?? $user->type,
            'ucode' => $validated['ucode'] ?? $user->ucode,
            'selected_menu' => $validated['selected_menu'] ?? $user->selected_menu,
            'current_state' => $validated['current_state'] ?? $user->current_state,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if (isset($validated['password']) && !empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $newAvatarPath = $userService->storeOrUpdateAvatar($user, $request->file('avatar'));
        $user->avatar = $newAvatarPath !== '' ? $newAvatarPath : null;

        $user->save();

        return Redirect::route('profile.index')->with('success', 'Perfil atualizado com sucesso');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function showWhatsAppSecurity(Request $request): View
    {
        return view('pclient.profile.whatsapp-security', [
            'user' => $request->user(),
        ]);
    }

    public function resetWhatsAppVerification(
        WhatsAppResetVerificationRequest $request,
        WhatsAppSecurityService $securityService
    ): RedirectResponse {
        $user = $request->user();

        $success = $securityService->resetVerification($user, $request->input('current_password'));

        if (!$success) {
            return back()->withErrors(['current_password' => 'Senha incorreta.']);
        }

        return back()->with('success', 'Verificação WhatsApp resetada com sucesso.');
    }

    public function authorizeNewDevice(
        AuthorizeDeviceRequest $request,
        WhatsAppSecurityService $securityService
    ): RedirectResponse {
        $user = $request->user();

        $success = $securityService->authorizeNewDevice(
            $user,
            $request->input('device_fingerprint'),
            $request->input('current_password')
        );

        if (!$success) {
            return back()->withErrors(['current_password' => 'Senha incorreta.']);
        }

        return back()->with('success', 'Novo dispositivo autorizado com sucesso.');
    }

    public function toggleMultipleDevices(Request $request, WhatsAppSecurityService $securityService): RedirectResponse
    {
        $request->validate([
            'allow_multiple_devices' => 'required|boolean',
        ]);

        $securityService->toggleMultipleDevices($request->user(), $request->input('allow_multiple_devices'));

        return back()->with('success', 'Configuração atualizada com sucesso.');
    }
}
