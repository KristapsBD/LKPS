<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\ParcelTracking;
use App\Models\Payment;
use App\Models\Tariff;
use App\Models\Vehicle;
use Database\Factories\VehicleFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Parcel;
use App\Models\Address;
// TODO CREATE PAYMENT TABLE
// TODO IMPLEMENT PARCEL STATUS CHANGE LOGGING TO DB
// TODO IMPLEMENT MANY TO MANY TABLES (ADDRESSUSER + USERVEHICEL)
// TODO REMOVE COUNTY ROW FROM ADDRESS TABLE
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $smallTariff = Tariff::factory()->create([
            'name' => 'Small Tariff',
            'price' => 5.00,
            'extra_information' => 'Tariff only applies to small size packages',
        ]);

        $mediumTariff = Tariff::factory()->create([
            'name' => 'Medium Tariff',
            'price' => 7.50,
            'extra_information' => 'Tariff only applies to medium size packages',
        ]);

        $largeTariff = Tariff::factory()->create([
            'name' => 'Large Tariff',
            'price' => 12.00,
            'extra_information' => 'Tariff only applies to large size packages',
        ]);

        $users = User::factory(10)->create();
        Client::factory(10)->create();
        Address::factory(10)->create();
        User::where('id', '<=', 5)->update(['role' => 2]);
        $vehicles = Vehicle::factory(10)->create();
        Tariff::factory(10)->create();
        Parcel::factory(10)->create();
        ParcelTracking::factory(10)->create();
        Payment::factory(10)->create();

        // Attach users to vehicles
        foreach ($vehicles as $vehicle) {
            $usersToAttach = User::inRandomOrder()->limit(3)->get();
            $vehicle->drivers()->attach($usersToAttach);
        }

        $sender = User::factory()->create([
            'name' => 'User Doe',
            'email' => 'kristaps.briks@inbox.lv',
            'phone' => '20289000',
            'password' => bcrypt('password'),
            'role' => 1,
        ]);

        $receiver = Client::factory()->create([
            'name' => 'Client Doe',
            'phone' => '20289000',
        ]);

        $address = Address::factory()->create([
            'street' => 'Iecavas 5',
            'city' => 'Ozolnieki',
            'postal_code' => 'LV-3018',
        ]);

        $parcel = Parcel::factory()->create([
            'size' => 's',
            'weight' => 10.0,
            'notes' => 'Sample parcel',
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'source_id' => $address->id,
            'destination_id' => $address->id,
        ]);
    }
}
