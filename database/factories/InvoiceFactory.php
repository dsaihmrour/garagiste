<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'additionalCharges' => $this->faker->randomFloat(2, 0, 100),
            'totalAmount' => $this->faker->randomFloat(2, 1, 1000),
            "dueDate" => $this->faker->date(),
            "description" => $this->faker->paragraph(3)
        ];
    }
}
