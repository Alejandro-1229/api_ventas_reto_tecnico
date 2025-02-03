<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'type_of_id_id' => $this->faker->numberBetween(1, 2),
            'numero_identidad' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'correo' => fake()->unique()->safeEmail()
        ];
    }
}
