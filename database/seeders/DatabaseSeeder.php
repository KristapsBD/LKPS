<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Parcel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'kristaps.briks@inbox.lv',
            'password' => bcrypt('password'), // Replace with the desired password
        ]);

        $parcel = Parcel::factory()->create([
            'parcel_size' => 's',
            'parcel_weight' => 10.0,
            'additional_notes' => 'Sample parcel',
            'sender_user_id' => $user->id,
        ]);
    }
}
