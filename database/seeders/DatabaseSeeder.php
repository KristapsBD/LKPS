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
        // Create tariffs
        $tariffs = include('tariffs.php');
        foreach ($tariffs as $tariff) {
            Tariff::create([
                'name' => $tariff['name'],
                'price' => $tariff['price'],
                'extra_information' => $tariff['extra_information'],
                'is_public' => $tariff['is_public'],
            ]);
        }

        // Create addresses
        $latvianAddresses = include('latvian_addresses.php');
        foreach ($latvianAddresses as $latvianAddress) {
            Address::create([
                'street' => $latvianAddress['street'],
                'city' => $latvianAddress['city'],
                'postal_code' => $latvianAddress['postal_code'],
            ]);
        }

        User::factory(10)->create();
        Client::factory(10)->create();
        User::where('id', '<=', 5)->update(['role' => 2]);
        $vehicles = Vehicle::factory(10)->create();
        Parcel::factory(10)->create();
        ParcelTracking::factory(10)->create();
        Payment::factory(10)->create();

        // Attach users to vehicles
        foreach ($vehicles as $vehicle) {
            $usersToAttach = User::inRandomOrder()->limit(3)->get();
            $vehicle->drivers()->attach($usersToAttach);
        }

        $sender = User::create([
            'name' => 'Kristaps Briks',
            'email' => 'kristaps.briks@inbox.lv',
            'phone' => '+37120289000',
            'password' => bcrypt('password'),
            'role' => 1,
        ]);

        $receiver = Client::create([
            'name' => 'Janis Klavins',
            'email' => 'kristaps.briks3@gmail.com',
            'phone' => '+37120289000',
        ]);

        $address_ozolnieki = Address::create([
            'street' => 'Iecavas 5',
            'city' => 'Ozolnieki',
            'postal_code' => 'LV-3018',
        ]);

        $address_riga = Address::create([
            'street' => 'Raiņa Bulvāris 19',
            'city' => 'Rīga',
            'postal_code' => 'LV-1050',
        ]);

        $address_ogre = Address::create([
            'street' => 'Upes prospekts 11',
            'city' => 'Ogre',
            'postal_code' => 'LV-5001',
        ]);

        $parcel_ozolnieki = Parcel::create([
            'size' => 's',
            'weight' => 10.0,
            'notes' => 'Sample parcel Ozolnieki',
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'source_id' => $address_ozolnieki->id,
            'destination_id' => $address_riga->id,
        ]);

        $randomReceiver = Client::inRandomOrder()->first();

        $parcel_riga = Parcel::create([
            'size' => 'm',
            'weight' => 15.0,
            'notes' => 'Sample parcel Riga',
            'sender_id' => $sender->id,
            'receiver_id' => $randomReceiver->id,
            'source_id' => $address_riga->id,
            'destination_id' => $address_ozolnieki->id,
        ]);

        $randomReceiver = Client::inRandomOrder()->first();

        $parcel_ogre = Parcel::create([
            'size' => 'l',
            'weight' => 20.0,
            'notes' => 'Sample parcel Ogre',
            'sender_id' => $sender->id,
            'receiver_id' => $randomReceiver->id,
            'source_id' => $address_ozolnieki->id,
            'destination_id' => $address_ogre->id,
        ]);

        $payment_ozolnieki = Payment::create([
            'parcel_id' => $parcel_ozolnieki->id,
            'sum' => 20,
            'status' => 1,
        ]);

        $payment_riga = Payment::create([
            'parcel_id' => $parcel_riga->id,
            'sum' => 55,
            'status' => 1,
        ]);

        $payment_ogre = Payment::create([
            'parcel_id' => $parcel_ogre->id,
            'sum' => 75,
            'status' => 1,
        ]);
    }
}
