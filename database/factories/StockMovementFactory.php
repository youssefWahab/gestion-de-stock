<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockMovement>
 */
class StockMovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stock_id' => Stock::factory(),
            'type' => $this->faker->randomElement(['entrée', 'sortie', 'retour', 'ajustement']),
            'quantite' => $this->faker->numberBetween(1, 100),
            'reference' => $this->faker->unique()->numberBetween(1000, 9999),
            'date_movement' => $this->faker->dateTimeThisYear(),
            'note' => $this->faker->sentence(),
        ];
    }
}
