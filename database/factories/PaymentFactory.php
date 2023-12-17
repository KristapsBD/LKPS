<?php

namespace Database\Factories;

use App\Models\Parcel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $parcel = Parcel::inRandomOrder()->first();

        return [
            'parcel_id' => $parcel->id,
            'sum' => $this->faker->randomFloat(2, 10, 200),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
