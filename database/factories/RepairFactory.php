<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repair>
 */
class RepairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'in progress', 'completed']),
            'startDate' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'endDate' => $this->faker->dateTimeBetween($min = '-1 year', $max = 'now', $timezone = null),
            'mechanicNotes' => $this->faker->paragraph(),
            'clientNotes' => $this->faker->paragraph(),
            "hourPrice" => $this->faker->randomFloat(2, 1000, 10000),
            "hours" => $this->faker->randomNumber(),
            "workPrice" => $this->faker->randomFloat(2, 1000, 10000),
            "title" => $this->faker->title()
        ];
    }
}
