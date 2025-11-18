<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Models\Broker;
use App\Models\Subscription;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            // Criar o usuário
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 2, // Broker
                'phone' => $request->phone,
            ]);

            $broker = Broker::create([
                'user_id' => $user->id,
                'subscription_id' => null,
                'plan_type' => \App\Enums\PlanType::BASIC->value,
                'subscription_expires_at' => null,
            ]);

            DB::commit();

            event(new Registered($user));
            Auth::login($user);


            return redirect(route('homepage.index', absolute: false));

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Erro ao registrar usuário', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['password', 'password_confirmation'])
            ]);

            throw $e;
        }
    }
}
