<?php

namespace Database\Factories;

use App\Enums\Participant\RelationshipType;
use App\Models\Lead;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    protected $model = Participant::class;

    public function definition(): array
    {
        $relationshipType = $this->faker->randomElement(RelationshipType::cases());

        return [
            'lead_id' => Lead::inRandomOrder()->first()?->id ?? 1,
            'name' => \App\Helpers\NameGenerator::getName(),
            'birth_date' => $this->faker->optional(0.8)->dateTimeBetween('-80 years', '-18 years'),
            'relationship_type' => $relationshipType,
            'relationship_type_other' => $relationshipType === RelationshipType::OTHER
                ? $this->faker->randomElement(['Primo', 'Sobrinho', 'Tio', 'Avô', 'Avó', 'Cunhado', 'Cunhada'])
                : null,
            'cpf' => $this->faker->optional(0.6)->numerify('###.###.###-##'),
            'weight' => $this->faker->optional(0.7)->randomFloat(2, 40, 150),
            'height' => $this->faker->optional(0.7)->randomFloat(2, 1.40, 2.00),
            'additional_notes' => $this->faker->optional(0.3)->paragraph(),
        ];
    }

    public function forLead(int $leadId): static
    {
        return $this->state(fn (array $attributes) => [
            'lead_id' => $leadId,
        ]);
    }

    public function spouse(): static
    {
        return $this->state(fn (array $attributes) => [
            'relationship_type' => RelationshipType::SPOUSE,
            'relationship_type_other' => null,
        ]);
    }

    public function child(): static
    {
        return $this->state(fn (array $attributes) => [
            'relationship_type' => $this->faker->randomElement([RelationshipType::FATHER, RelationshipType::MOTHER]),
            'relationship_type_other' => null,
            'birth_date' => $this->faker->dateTimeBetween('-25 years', '-1 year'),
        ]);
    }

    public function employee(): static
    {
        return $this->state(fn (array $attributes) => [
            'relationship_type' => RelationshipType::EMPLOYEE,
            'relationship_type_other' => null,
        ]);
    }
}
