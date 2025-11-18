<?php

namespace App\Console\Commands;

use App\Services\StripePlanService;
use Illuminate\Console\Command;

class SyncPlansWithStripe extends Command
{
    protected $signature = 'stripe:sync-plans';
    protected $description = 'Sincronizar planos do Stripe com o banco de dados local';

    public function handle(StripePlanService $planService): int
    {
        $this->info('Iniciando sincronização de planos com Stripe...');

        $results = $planService->syncPlansWithStripe();

        $this->info("Planos criados: {$results['created']}");
        $this->info("Planos atualizados: {$results['updated']}");
        $this->info("Planos desativados: {$results['deactivated']}");

        if ($results['errors'] > 0) {
            $this->error("Erros encontrados: {$results['errors']}");
        }

        $this->info('Sincronização concluída!');

        return Command::SUCCESS;
    }
}
