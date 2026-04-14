<?php

namespace Database\Factories;

use App\Models\DemandeAchat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FicheCommande>
 */
class FicheCommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'demande_achat_id' => DemandeAchat::factory(),
            'nomDemandeur' => $this->faker->name,
            'chantier' => $this->faker->company,
            'chefAtelier' => $this->faker->name,
            'atelier' => $this->faker->word,
            'dateCommande' => $this->faker->date(),
            'description' => $this->faker->sentence(6),
            'schemaPlan' => 'schemas/GLFiN5TZhutuzT4mdl2PdATQOAESIkBH1WLZ51Js.png',
        ];
    }
}
