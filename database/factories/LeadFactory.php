<?php

namespace Database\Factories;

use App\Enums\Lead\LeadPricingType;
use App\Enums\Lead\LeadStatus;
use App\Enums\Lead\LeadTemperature;
use App\Enums\Lead\LeadType;
use App\Models\Lead;
use App\Models\Broker;
use App\Models\Supplier;
use App\Models\HealthOperator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        $leadType = $this->faker->randomElement([LeadType::PF, LeadType::PJ, LeadType::ADESAO]);
        $isCompany = in_array($leadType, [LeadType::PJ]);

        return [
            'supplier_id' => Supplier::inRandomOrder()->first()?->id ?? 1,
            'broker_id' => Broker::inRandomOrder()->first()?->id ?? 1,
            'responsible_id' => Broker::inRandomOrder()->first()?->id ?? 1,
            'health_operator_id' => HealthOperator::inRandomOrder()->first()?->id ?? 1,
            'name' => $isCompany ? \App\Helpers\NameGenerator::getCompanyName() : \App\Helpers\NameGenerator::getName(),
            'corporateName' => $isCompany ? \App\Helpers\NameGenerator::getCompanyName() : null,
            'phone' => $this->faker->numerify('###########'),
            'email' => $this->faker->unique()->safeEmail(),
            'type' => $leadType,
            'cpf' => in_array($leadType, [LeadType::PF, LeadType::ADESAO]) ? $this->faker->numerify('###.###.###-##') : null,
            'cnpj' => in_array($leadType, [LeadType::PJ]) ? $this->faker->numerify('##.###.###/####-##') : null,
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'status' => $this->faker->randomElement(LeadStatus::cases()),
            'step' => $this->faker->numberBetween(1, 8),
            'temperature' => $this->faker->randomElement(LeadTemperature::cases()),
            'traking' => $this->faker->optional(0.6)->randomElement(['TRK001', 'TRK002', 'TRK003', 'TRK004', 'TRK005']),
            'source' => $this->faker->randomElement(['Google Ads', 'Facebook', 'Indicação']),
            'code' => Str::uuid(),
            'isAutomation' => $this->faker->boolean(),
            'lifes' => $this->faker->numberBetween(1, 5),
            'acceptContestation' => $this->faker->boolean(),
            'description' => $this->faker->paragraph(),
            'startPrice' => $this->faker->randomFloat(2, 10, 1000),
            'currentPrice' => $this->faker->randomFloat(2, 10, 1000),
            'negotiatedPrice' => $this->faker->optional(0.7)->randomFloat(2, 10, 1000),
            'pricingType' => $this->faker->randomElement(LeadPricingType::cases()),
            'depreciationPercent' => $this->faker->numberBetween(5, 30),
            'depreciationInterval' => $this->faker->numberBetween(1, 30),
            'lead_expires_at' => $this->faker->dateTimeBetween('now', '+30 days'),
            'acquired_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }

    public function available(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => LeadStatus::AVAILABLE,
            'broker_id' => null,
            'responsible_id' => null,
        ]);
    }

    public function purchased(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => LeadStatus::SOLD,
            'broker_id' => Broker::inRandomOrder()->first()?->id ?? 1,
            'responsible_id' => Broker::inRandomOrder()->first()?->id ?? 1,
        ]);
    }

    public function forSupplier(int $supplierId): static
    {
        return $this->state(fn (array $attributes) => [
            'supplier_id' => $supplierId,
            'broker_id' => null, // Supplier é o dono
            'responsible_id' => null, // Supplier não tem responsável
        ]);
    }

    public function forBroker(int $brokerId): static
    {
        return $this->state(fn (array $attributes) => [
            'broker_id' => $brokerId,
            'responsible_id' => $brokerId,
        ]);
    }

    public static function createForSpecificBrokers(array $brokerData): void
    {
        foreach ($brokerData as $broker) {
            $user = \App\Models\User::where('email', $broker['email'])->first();

            if (!$user) {
                continue;
            }

            $brokerModel = \App\Models\Broker::where('user_id', $user->id)->first();

            if (!$brokerModel) {
                continue;
            }

            \App\Models\Lead::factory($broker['quantity'])
                ->forBroker($brokerModel->id)
                ->create();
        }
    }
}
