<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $entree = $this->faker->numberBetween(10, 200);
        $sortie = $this->faker->numberBetween(0, $entree);
        return [
            'article' => $this->faker->word,
            'atelier' => $this->faker->company,
            'unite' => $this->faker->randomElement(['m', 'm²', 'cm']),
            'entree' => $entree,
            'sortie' => $sortie,
            'stockInitial' => $this->faker->numberBetween(0, 50),
            'stockActuel' => $entree - $sortie,
            'minimum' => $this->faker->numberBetween(0, 20),
        ];
    }
}
