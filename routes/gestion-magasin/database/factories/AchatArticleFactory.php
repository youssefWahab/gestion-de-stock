<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AchatArticle>
 */
class AchatArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'demande_achat_id' => 1,
            'stock_id' => 1,
            'articleDemande' => $this->faker->word(),
            'quantite' => $this->faker->numberBetween(1, 100),
            'unite' => $this->faker->randomElement(['m', 'm²', 'cm']),
            'prix' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
