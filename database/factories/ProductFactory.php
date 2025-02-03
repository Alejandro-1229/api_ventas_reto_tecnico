<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => $this->faker->unique()->regexify('[A-Z0-9]{10}'), 
            'nombre' => $this->faker->word, 
            'descripcion' => $this->faker->sentence, 
            'precio_unitario' => $this->faker->randomFloat(2, 1, 1000), 
            'stock' => $this->faker->numberBetween(0, 100),
            'state_id' => $this->faker->numberBetween(1, 2), 
        ];
    }
}
