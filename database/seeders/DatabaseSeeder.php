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
            'is_public' => 1,
        ]);

        $mediumTariff = Tariff::factory()->create([
            'name' => 'Medium Tariff',
            'price' => 7.50,
            'extra_information' => 'Tariff only applies to medium size packages',
            'is_public' => 1,
        ]);

        $largeTariff = Tariff::factory()->create([
            'name' => 'Large Tariff',
            'price' => 12.00,
            'extra_information' => 'Tariff only applies to large size packages',
            'is_public' => 1,
        ]);

        $largeTariff = Tariff::factory()->create([
            'name' => 'Extra Large Tariff',
            'price' => 20.00,
            'extra_information' => 'Tariff only applies to extra large size packages',
            'is_public' => 1,
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
            'email' => 'kristaps.briks@inbox.lv',
            'phone' => '20289000',
        ]);

        $address_ozolnieki = Address::factory()->create([
            'street' => 'Iecavas 5',
            'city' => 'Ozolnieki',
            'postal_code' => 'LV-3018',
        ]);

        $address_riga = Address::factory()->create([
            'street' => 'Raina Bulvaris 19',
            'city' => 'Riga',
            'postal_code' => 'LV-1050',
        ]);

        $address_ogre = Address::factory()->create([
            'street' => 'Upes prospekts 11',
            'city' => 'Ogre',
            'postal_code' => 'LV-5001',
        ]);

        $parcel_ozolnieki = Parcel::factory()->create([
            'size' => 's',
            'weight' => 10.0,
            'notes' => 'Sample parcel Ozolnieki',
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'source_id' => $address_ozolnieki->id,
            'destination_id' => $address_riga->id,
        ]);

        $randomReceiver = Client::inRandomOrder()->first();

        $parcel_riga = Parcel::factory()->create([
            'size' => 'm',
            'weight' => 15.0,
            'notes' => 'Sample parcel Riga',
            'sender_id' => $sender->id,
            'receiver_id' => $randomReceiver->id,
            'source_id' => $address_riga->id,
            'destination_id' => $address_ozolnieki->id,
        ]);

        $randomReceiver = Client::inRandomOrder()->first();

        $parcel_ogre = Parcel::factory()->create([
            'size' => 'l',
            'weight' => 20.0,
            'notes' => 'Sample parcel Ogre',
            'sender_id' => $sender->id,
            'receiver_id' => $randomReceiver->id,
            'source_id' => $address_ozolnieki->id,
            'destination_id' => $address_ogre->id,
        ]);

        $payment_ozolnieki = Payment::factory()->create([
            'parcel_id' => $parcel_ozolnieki->id,
            'sum' => 20,
            'status' => 1,
        ]);

        $payment_riga = Payment::factory()->create([
            'parcel_id' => $parcel_riga->id,
            'sum' => 55,
            'status' => 1,
        ]);

        $payment_ogre = Payment::factory()->create([
            'parcel_id' => $parcel_ogre->id,
            'sum' => 75,
            'status' => 1,
        ]);
    }
}
