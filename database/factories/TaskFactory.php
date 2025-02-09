<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'client_id' => 1,
            'device' => fake()->name(),
            'brand' => fake()->name(),
            'model' => null,
            'serial_number' => null,
            'description' => fake()->address(),
            'price' => 0,
            'status' => 0
        ];
    }
}
