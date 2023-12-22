<?php

namespace Database\Factories;

use App\Models\User;
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
        $driver = User::where('role', 2)->inRandomOrder()->first();

        return [
            'registration_number' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'type' => $this->faker->randomElement([1, 2, 3]),
            'status' => $this->faker->randomElement([0, 1]),
            'current_driver_id' => $driver->id,
        ];
    }
}
