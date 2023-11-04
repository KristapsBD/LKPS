<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parcel>
 */
class ParcelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parcel_size' => $this->faker->randomElement(['s', 'm', 'l', 'xl']),
            'parcel_weight' => $this->faker->numberBetween(1, 100),
            'additional_notes' => $this->faker->text,
        ];
    }
}
