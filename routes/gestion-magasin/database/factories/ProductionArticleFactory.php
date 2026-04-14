<?php

namespace Database\Factories;

use App\Models\DemandeAchat;
use App\Models\Production;
use App\Models\ProductionArticle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductionArticle>
 */
class ProductionArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductionArticle::class;
    public function definition(): array
    {
        return [
            'numProduction' => 1,
            // 'numBonCommande' => 1,
            'articleDemande' => $this->faker->word,
            'quantite' => $this->faker->numberBetween(1, 300),
            'unite' => $this->faker->randomElement(['cm','m', 'm²']),
            'prix' => $this->faker->randomFloat(2, 50, 1500),
        ];
    }
}
