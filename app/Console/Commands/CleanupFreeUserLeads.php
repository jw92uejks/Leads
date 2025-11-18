<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\LeadLimitService;
use Illuminate\Console\Command;

class CleanupFreeUserLeads extends Command
{
    protected $signature = 'leads:cleanup-free-users {--dry-run : Apenas simular, não deletar}';

    protected $description = 'Remove leads excedentes de usuários BASIC (acima de 100 leads)';

    public function __construct(
        private readonly LeadLimitService $leadLimitService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $isDryRun = $this->option('dry-run');

        if ($isDryRun) {
            $this->info('🔍 MODO SIMULAÇÃO - Nenhum lead será deletado');
        }

        $basicUsers = User::where('role_id', 2)->get();
        $totalRemoved = 0;

        foreach ($basicUsers as $user) {
            if (!$user->isBasicPlan() || !$user->broker) {
                continue;
            }

            $currentLeads = $this->leadLimitService->getCurrentLeadsCount($user);
            $maxLeads = $this->leadLimitService->getMaxLeadsLimit($user);

            if ($currentLeads <= $maxLeads) {
                continue;
            }

            $excessLeads = $currentLeads - $maxLeads;
            $leadsToRemove = $user->broker->leads()
                ->orderBy('created_at', 'desc')
                ->limit($excessLeads)
                ->get();

            $this->info("Usuário: {$user->name} ({$user->email})");
            $this->info("  - Leads atuais: {$currentLeads}");
            $this->info("  - Limite máximo: {$maxLeads}");
            $this->info("  - Leads excedentes: {$excessLeads}");

            if (!$isDryRun) {
                $leadsToRemove->each(function ($lead) {
                    $lead->delete();
                });
                $this->info("  ✅ {$excessLeads} leads removidos");
            } else {
                $this->info("  🔍 {$excessLeads} leads seriam removidos (simulação)");
            }

            $totalRemoved += $excessLeads;
            $this->newLine();
        }

        if ($totalRemoved > 0) {
            if ($isDryRun) {
                $this->info("🔍 Total de leads que seriam removidos: {$totalRemoved}");
                $this->info("Execute sem --dry-run para confirmar a remoção");
            } else {
                $this->info("✅ Total de leads removidos: {$totalRemoved}");
            }
        } else {
                            $this->info("✅ Nenhum usuário BASIC com leads excedentes encontrado");
        }
    }
}
