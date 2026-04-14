<?php

namespace Database\Factories;

use App\Models\Consommation;
use App\Models\DemandeAchat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consommation>
 */
class ConsommationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Consommation::class;

    public function definition(): array
    {
        return [
           'chantier' => $this->faker->company,
           'article' => $this->faker->word,
           'demande_achat_id' => DemandeAchat::factory(),
            'numProduction' => 1,
            'quantiteDemande' => $this->faker->numberBetween(1, 150),
            'quantiteConsomme' => $this->faker->numberBetween(1, 150),
            'unite' => $this->faker->randomElement(['kg', 'm³', 'pièce']),
            'coutUnitaire' => $this->faker->randomFloat(2, 5, 500),
        ];
    }
}
