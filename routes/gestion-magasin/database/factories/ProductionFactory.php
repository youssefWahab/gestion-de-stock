<?php

namespace Database\Factories;

use App\Models\DemandeAchat;
use App\Models\Production;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Production>
 */
class ProductionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chantier' => $this->faker->company,
            'produitFinale' => $this->faker->word(),
            'numBonTransfert' => 'BC-' . $this->faker->unique()->numberBetween(1000, 9999),
            'quantite' => $this->faker->numberBetween(1, 300),
            'unite' => $this->faker->randomElement(['kg', 'litre', 'pièce']),
            'coutReviens' => $this->faker->randomFloat(2, 50, 2000),
            // 'numBonCommande' => 1,
            // 'demande_achat_id' => DemandeAchat::factory(),
        ];
    }
}
