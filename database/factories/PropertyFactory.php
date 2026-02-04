<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => $this->faker->numberBetween(100000, 10000000),
            'area' => $this->faker->numberBetween(50, 1000),
            'rooms' => $this->faker->numberBetween(1, 10),
            'bathrooms' => $this->faker->numberBetween(1, 5),
            'is_available' => $this->faker->boolean(80),
            'in_home' => $this->faker->boolean(50),
            'view_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
