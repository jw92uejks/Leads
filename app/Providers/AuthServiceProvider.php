<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        //
    ];

    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->hasRole('admin');
        });

        Gate::define('suadmin', function (User $user) {
            return $user->hasRole('suadmin');
        });

        Gate::define('broker', function (User $user) {
            return $user->hasRole('broker');
        });

        Gate::define('supplier', function (User $user) {
            return $user->hasRole('supplier');
        });

        Gate::define('basic', function (User $user) {
            return $user->isBasicPlan();
        });

        Gate::define('individual-plan', function (User $user) {
            return $user->isIndividualPlan();
        });

        Gate::define('teams-plan', function (User $user) {
            return $user->isTeamsPlan();
        });

        Gate::define('enterprise-plan', function (User $user) {
            return $user->isEnterprisePlan();
        });

        Gate::define('has-subscription', function (User $user) {
            return $user->hasActiveSubscription();
        });

        Gate::define('can-create-teams', function (User $user) {
            return $user->canCreateTeams();
        });

        Gate::define('can-access-connections', function (User $user) {
            return $user->canAccessConnections();
        });

        Gate::define('can-access-automations', function (User $user) {
            return $user->canAccessAutomations();
        });

        Gate::define('can-manage-teams', function (User $user) {
            return $user->canManageTeams();
        });
    }
}