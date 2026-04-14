<?php

namespace Database\Factories;

use App\Models\ChargePersonnel;
use App\Models\Production;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChargePersonnel>
 */
class ChargePersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ChargePersonnel::class;

    public function definition(): array
    {
        return [
            'numProduction' => 1,
            'nom' => $this->faker->name,
            'role' => $this->faker->jobTitle,
            // 'cout' => $this->faker->randomFloat(2, 100, 2000),
        ];
    }
}
