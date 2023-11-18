<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Parcel;
use App\Models\Address;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Client::factory(10)->create();
        \App\Models\Address::factory(10)->create();
        User::where('id', '<=', 5)->update(['role' => 3]);
        \App\Models\Vehicle::factory(10)->create();
        \App\Models\Tariff::factory(10)->create();
        \App\Models\Parcel::factory(10)->create();
        \App\Models\ParcelTracking::factory(10)->create();

        $sender = User::factory()->create([
            'name' => 'User Doe',
            'email' => 'kristaps.briks@inbox.lv',
            'phone' => '20289000',
            'password' => bcrypt('password'),
            'role' => 1,
        ]);

        $receiver = Client::factory()->create([
            'name' => 'Client Doe',
            'email' => 'kristaps.briks@inbox.lv',
            'phone' => '20289000',
        ]);

        $address = Address::factory()->create([
            'street' => 'Iecavas 5',
            'city' => 'Ozolnieki',
            'postal_code' => 'LV-3018',
            'county' => 'Jelgavas novads',
        ]);

        $parcel = Parcel::factory()->create([
            'size' => 's',
            'weight' => 10.0,
            'notes' => 'Sample parcel',
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
        ]);
    }
}
