<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lead;
use App\Models\Supplier;
use App\Models\User;
use App\Services\LeadLimitService;
use App\Enums\Lead\LeadStatus;
use App\Enums\Lead\LeadType;
use Illuminate\Support\Facades\DB;

class LeadSeeder extends Seeder
{
    public function __construct(
        private readonly LeadLimitService $leadLimitService
    ) {}

    public function run(): void
    {
        $suppliers = Supplier::where('status', 'approved')->get();

        if ($suppliers->isEmpty()) {
            $this->command->warn('Nenhum fornecedor aprovado encontrado.');
            return;
        }

        $healthOperators = \App\Models\HealthOperator::all();

        if ($healthOperators->isEmpty()) {
            $this->command->warn('Nenhuma operadora de saúde encontrada.');
            return;
        }

        foreach ($suppliers as $supplier) {
            $this->command->info("Criando leads para o fornecedor {$supplier->name}...");

            Lead::factory(50)
                ->available()
                ->forSupplier($supplier->id)
                ->create();
        }

        Lead::factory(100)->purchased()->create();

        $brokerData = [
            [
                'email' => 'guilherme@exemplo.com',
                'quantity' => 28
            ],
            [
                'email' => 'bruno@exemplo.com',
                'quantity' => 28
            ]
        ];

        $this->createLeadsForSpecificBrokers($brokerData);

        $totalLeads = Lead::count();
        $availableLeads = Lead::where('status', LeadStatus::AVAILABLE)->count();
        $purchasedLeads = Lead::where('status', LeadStatus::SOLD)->count();

        $pfCount = Lead::where('type', LeadType::PF)->count();
        $pmeCount = Lead::where('type', LeadType::PJ)->count();
        $adesaoCount = Lead::where('type', LeadType::ADESAO)->count();
        $mistaCount = Lead::where('type', LeadType::MISTA)->count();

        $this->command->info('=== Estatísticas de Leads por Tipo ===');
        $this->command->info("- PF (Pessoa Física): {$pfCount} leads");
        $this->command->info("- PJ (Pessoa Jurídica): {$pmeCount} leads");
        $this->command->info("- ADESAO (Adesão): {$adesaoCount} leads");
        $this->command->info("- MISTA: {$mistaCount} leads");

        $this->command->info('=== Estatísticas Gerais ===');
        $this->command->info("- Total de leads: {$totalLeads}");
        $this->command->info("- Leads disponíveis: {$availableLeads}");
        $this->command->info("- Leads vendidos: {$purchasedLeads}");

        $this->command->info('Leads criados com sucesso!');
    }

    /**
     * Cria leads para brokers específicos respeitando o limite de usuários BASIC.
     */
    private function createLeadsForSpecificBrokers(array $brokerData): void
    {
        foreach ($brokerData as $broker) {
            $user = User::where('email', $broker['email'])->first();

            if (!$user) {
                $this->command->warn("Usuário {$broker['email']} não encontrado.");
                continue;
            }

            $brokerModel = \App\Models\Broker::where('user_id', $user->id)->first();

            if (!$brokerModel) {
                $this->command->warn("Broker não encontrado para o usuário {$broker['email']}.");
                continue;
            }

            // Verificar se é usuário BASIC e calcular quantidade respeitando o limite
            $maxLeads = $this->leadLimitService->getMaxLeadsLimit($user);
            $currentLeads = $this->leadLimitService->getCurrentLeadsCount($user);
            $remainingSlots = max(0, $maxLeads - $currentLeads);

            $quantityToCreate = min($broker['quantity'], $remainingSlots);

            if ($quantityToCreate <= 0) {
                $this->command->warn("Usuário {$broker['email']} já atingiu o limite de leads ({$currentLeads}/{$maxLeads}). Pulando criação.");
                continue;
            }

            if ($quantityToCreate < $broker['quantity']) {
                $this->command->info("Usuário {$broker['email']} é BASIC. Criando apenas {$quantityToCreate} leads (limite: {$maxLeads}, atuais: {$currentLeads}).");
            }

            Lead::factory($quantityToCreate)
                ->forBroker($brokerModel->id)
                ->create();

            $this->command->info("Criados {$quantityToCreate} leads para {$broker['email']}.");
        }
    }
}