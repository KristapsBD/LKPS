<?php

namespace Database\Factories;

use App\Models\Parcel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ParcelTrackingFactory extends Factory
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
            'status' => $parcel->status,
            'location' => $this->faker->city,
        ];
    }
}
