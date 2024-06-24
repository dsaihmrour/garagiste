<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => $this->faker->word,
            'model' => $this->faker->word,
            'fuelType' => $this->faker->word,
            'registration' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{4}[A-Z]{2}'), // Change to a valid vehicle registration
            'photos' => $this->faker->randomElements([
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
            ], $this->faker->numberBetween(1, 5)),
        ];
    } // You may add logic to generate or link photos here
}
