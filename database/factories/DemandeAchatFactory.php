<?php

namespace Database\Factories;

use App\Models\DemandeAchat;
use App\Models\FicheCommande;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DemandeAchat>
 */
class DemandeAchatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numFiche' => 1,
            // 'numFiche' => FicheCommande::all()->random()->id, 
            'numBonCommande' => 'BC-' . $this->faker->unique()->numberBetween(1000, 9999),
            'atelier' => $this->faker->randomElement(['Atelier A', 'Atelier B', 'Atelier C']),
            'natureTravaux' => $this->faker->sentence(3),
            // 'articleDemande' => $this->faker->word,
            // 'quantite' => $this->faker->numberBetween(1, 500),
            // 'unite' => $this->faker->randomElement(['m', 'm²', 'cm']),
            // 'prix' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
