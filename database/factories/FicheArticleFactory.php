<?php

namespace Database\Factories;

use App\Models\FicheArticle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FicheArticle>
 */
class FicheArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = FicheArticle::class;
    public function definition(): array
    {
        return [
            'fiche_numFiche' => 1,
            'articleDemande' => $this->faker->word(),
            'quantite' => $this->faker->numberBetween(1, 100),
            'unite' => $this->faker->randomElement(['m', 'm²', 'cm']),
            // 'prix' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
