<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lead;
use App\Models\LeadAutomation;
use App\Enums\Lead\LeadStatus;

class LeadAutomationSeeder extends Seeder
{
    public function run(): void
    {
        $purchasedLeads = Lead::where('status', LeadStatus::SOLD)
            ->whereDoesntHave('automation')
            ->limit(50)
            ->get();

        if ($purchasedLeads->isEmpty()) {
            $this->command->warn('Nenhum lead vendido encontrado para criar automações.');
            return;
        }

        $assistStatuses = ['active', 'pending', 'in_progress', 'completed', 'paused'];
        $assistSubstatuses = ['awaiting_payment', 'awaiting_documents', 'under_review', 'approved', 'rejected'];
        $currentStates = ['initial_contact', 'negotiation', 'contract_sent', 'contract_signed', 'finalized'];
        $holidays = ['Christmas', 'New Year', 'Easter', 'Independence Day', null];
        $importantUpdates = ['Renewal reminder sent', 'Contract updated', 'Payment received', 'Documents pending', null];

        foreach ($purchasedLeads as $lead) {
            LeadAutomation::create([
                'lead_id' => $lead->id,
                'assist_status' => fake()->randomElement($assistStatuses),
                'assist_substatus' => fake()->randomElement($assistSubstatuses),
                'estimated_payment' => fake()->boolean(70) ? now()->addDays(rand(1, 60)) : null,
                'billetdue_date' => fake()->boolean(60) ? now()->addDays(rand(5, 30)) : null,
                'renewal_date' => now()->addMonths(rand(3, 12)),
                'selected_menu' => fake()->numberBetween(1, 5),
                'current_state' => fake()->randomElement($currentStates),
                'birthday' => fake()->boolean(40) ? fake()->dateTimeBetween('-60 years', '-18 years') : null,
                'wedding' => fake()->boolean(30) ? fake()->dateTimeBetween('-20 years', '-1 year') : null,
                'company_niver' => fake()->boolean(25) ? fake()->dateTimeBetween('-30 years', '-1 year') : null,
                'holidays' => fake()->randomElement($holidays),
                'important_updates' => fake()->randomElement($importantUpdates),
                'periodic_contact' => fake()->boolean(80) ? now()->addDays(rand(7, 45)) : null,
            ]);
        }

        $createdCount = LeadAutomation::count();
        $this->command->info("✓ {$createdCount} automações de leads criadas com sucesso!");
    }
}
