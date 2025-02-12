<?php

namespace Database\Factories;

use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Size>
 */
class SizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->randomElement(['180ml, 250ml, 330ml']),
            'valor' => $this->faker->randomFloat(0, 7, 12),
            'max_cremes'=> $this->faker->numberBetween(1, 2),
            'max_recheios'=> $this->faker->numberBetween(1, 3),
            'max_acompanhamentos'=> $this->faker->numberBetween(1, 3),
            'max_coberturas'=> $this->faker->numberBetween(1, 3),
        ];
    }
}
