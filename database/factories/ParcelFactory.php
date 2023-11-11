<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
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
        $sender = User::factory()->create();
        $receiver = Client::factory()->create();

        return [
            'size' => $this->faker->randomElement(['s', 'm', 'l', 'xl']),
            'weight' => $this->faker->numberBetween(1, 100),
            'notes' => $this->faker->text,
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
        ];
    }
}
