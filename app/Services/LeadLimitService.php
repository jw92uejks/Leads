<?php

namespace App\Services;

use App\Models\User;
use App\Enums\UserRole;

class LeadLimitService
{
    public function getMaxLeadsLimit(User $user): int
    {
        if ($user->isBasicPlan()) {
            return 100;
        }

        if (!$user->broker || !$user->broker->subscription) {
            return 100;
        }

        return match($user->broker->subscription->plan_type) {
            'individual' => 100,
            'teams' => 150,
            'enterprise' => 200,
            default => 100,
        };
    }

    public function getCurrentLeadsCount(User $user): int
    {
        if (!$user->broker) {
            return 0;
        }

        return $user->broker->leads()->count();
    }

    public function canCreateMoreLeads(User $user): bool
    {
        $currentCount = $this->getCurrentLeadsCount($user);
        $maxLimit = $this->getMaxLeadsLimit($user);

        return $currentCount < $maxLimit;
    }

    public function getRemainingLeadsSlots(User $user): int
    {
        $currentCount = $this->getCurrentLeadsCount($user);
        $maxLimit = $this->getMaxLeadsLimit($user);

        return max(0, $maxLimit - $currentCount);
    }

    public function canAddToCart(User $user, int $itemsToAdd): bool
    {
        $currentCount = $this->getCurrentLeadsCount($user);
        $maxLimit = $this->getMaxLeadsLimit($user);

        return ($currentCount + $itemsToAdd) <= $maxLimit;
    }

    public function getLeadLimitInfo(User $user): array
    {
        return [
            'is_basic_user' => $user->isBasicPlan(),
            'is_individual_plan' => $this->isIndividualPlan($user),
            'is_teams_plan' => $this->isTeamsPlan($user),
            'is_enterprise_plan' => $this->isEnterprisePlan($user),
            'current_leads' => $this->getCurrentLeadsCount($user),
            'max_leads' => $this->getMaxLeadsLimit($user),
            'remaining_slots' => $this->getRemainingLeadsSlots($user),
            'can_create_more' => $this->canCreateMoreLeads($user),
            'plan_type' => $this->getPlanType($user),
            'plan_name' => $this->getPlanName($user),
        ];
    }

    private function isIndividualPlan(User $user): bool
    {
        return $user->broker &&
               $user->broker->subscription &&
               $user->broker->subscription->plan_type === 'individual';
    }

    private function isTeamsPlan(User $user): bool
    {
        return $user->broker &&
               $user->broker->subscription &&
               $user->broker->subscription->plan_type === 'teams';
    }

    private function isEnterprisePlan(User $user): bool
    {
        return $user->broker &&
               $user->broker->subscription &&
               $user->broker->subscription->plan_type === 'enterprise';
    }

    private function getPlanType(User $user): string
    {
        if ($user->isBasicPlan()) {
            return 'basic';
        }

        if (!$user->broker || !$user->broker->subscription) {
            return 'unknown';
        }

        return $user->broker->subscription->plan_type;
    }

    public function getPlanName(User $user): string
    {
        if ($user->isBasicPlan()) {
            return 'Básico';
        }

        if (!$user->broker || !$user->broker->subscription) {
            return 'Desconhecido';
        }

        return $user->broker->subscription->name;
    }
}