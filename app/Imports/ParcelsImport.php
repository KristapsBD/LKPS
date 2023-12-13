<?php

namespace App\Imports;

use App\Models\Address;
use App\Models\Client;
use App\Models\Tariff;
use App\Models\User;
use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Parcel;

class ParcelsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $sender = User::find($row['sender_id']);
        $receiver = Client::find($row['receiver_id']);
        $source = Address::find($row['source_id']);
        $destination = Address::find($row['destination_id']);
        $vehicle = Vehicle::find($row['vehicle_id']);
        $tariff = Tariff::find($row['tariff_id']);

        if (!$sender) {
            // Handle the case where the sender_id is not valid
            // You can log an error, skip the row, or take appropriate action
            return null;
        }

        $parcel = new Parcel([
            'size' => $row['size'],
            'weight' => $row['weight'],
            'notes' => $row['notes'],
            'status' => $row['status'],
            'tracking_code' => $row['tracking_code'],
        ]);

        $parcel->sender()->associate($sender);
        $parcel->source()->associate($source);
        $parcel->destination()->associate($destination);
        $parcel->vehicle()->associate($vehicle);
        $parcel->tariff()->associate($tariff);

        $parcel->save();
    }
}

//namespace App\Imports;
//
//use App\Models\Parcel;
//use App\Models\Client;
//use App\Models\User;
//use App\Models\Address;
//use App\Models\Vehicle;
//use App\Models\Tariff;
//use Illuminate\Support\Collection;
//use Maatwebsite\Excel\Concerns\ToCollection;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;
//use Maatwebsite\Excel\Concerns\Importable;
//use Maatwebsite\Excel\Concerns\WithValidation;
//
//class ParcelsImport implements ToCollection, WithHeadingRow, WithValidation
//{
//    use Importable;
//
//    /**
//     * @param Collection $collection
//     */
//    public function collection(Collection $collection)
//    {
//        foreach ($collection as $row) {
//            // Validate and get related records
//            $sender = User::find($row['sender_id']);
//            $receiver = Client::find($row['receiver_id']);
//            $source = Address::find($row['source']);
//            $destination = Address::find($row['destination']);
//            $vehicle = Vehicle::find($row['vehicle_id']);
//            $tariff = Tariff::find($row['tariff_id']);
//
//            // Check if any related record is not found
//            if (!$sender || !$receiver || !$source || !$destination || !$vehicle || !$tariff) {
//                $this->addError('invalid_id', 'Invalid ID provided for one or more foreign keys.');
//                return;
//            }
//
//            // Create Parcel
//            Parcel::factory()->create([
//                'size' => $row['size'],
//                'weight' => $row['weight'],
//                'notes' => $row['notes'],
//                'status' => $row['status'],
//                'tracking_code' => $row['tracking_code'],
//                'sender_id' => $sender->id,
//                'receiver_id' => $receiver->id,
//                'source' => $source->id,
//                'destination' => $destination->id,
//                'vehicle_id' => $vehicle->id,
//                'tariff_id' => $tariff->id,
//            ]);
//        }
//    }
//
//    /**
//     * Validation rules for the import.
//     *
//     * @return array
//     */
//    public function rules(): array
//    {
//        return [
//            'sender_id' => 'exists:users,id',
//            'receiver_id' => 'exists:clients,id',
//            'source' => 'exists:addresses,id',
//            'destination' => 'exists:addresses,id',
//            'vehicle_id' => 'exists:vehicles,id',
//            'tariff_id' => 'exists:tariffs,id',
//        ];
//    }
//}
