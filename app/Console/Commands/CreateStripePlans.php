<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Services\StripePlanService;
use Illuminate\Console\Command;

class CreateStripePlans extends Command
{
    protected $signature = 'stripe:create-plans';
    protected $description = 'Criar planos locais no Stripe Dashboard';

    public function handle(StripePlanService $planService): int
    {
        $this->info('Criando planos no Stripe Dashboard...');

        $plans = Subscription::whereNull('stripe_product_id')
            ->orWhereNull('stripe_price_id')
            ->get();

        if ($plans->isEmpty()) {
            $this->info('Todos os planos já estão sincronizados com o Stripe.');
            return Command::SUCCESS;
        }

        $created = 0;
        $errors = 0;

        foreach ($plans as $plan) {
            $this->info("Criando plano: {$plan->name}");

            $result = $planService->createPlanInStripe($plan);

            if ($result['success']) {
                $this->info("✓ Plano criado - Product ID: {$result['product_id']}, Price ID: {$result['price_id']}");
                $created++;
            } else {
                $this->error("✗ Erro ao criar plano: {$result['error']}");
                $errors++;
            }
        }

        $this->info("Planos criados: {$created}");

        if ($errors > 0) {
            $this->error("Erros: {$errors}");
        }

        return Command::SUCCESS;
    }
}
