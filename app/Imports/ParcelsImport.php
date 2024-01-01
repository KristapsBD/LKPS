<?php

namespace App\Imports;

use App\Models\Address;
use App\Models\Client;
use App\Models\Tariff;
use App\Models\User;
use App\Models\Vehicle;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Parcel;

class ParcelsImport implements ToCollection, WithHeadingRow
{
    protected $errors = [];
    protected $importCount = 0;

    public function collection(Collection $collection)
    {
        // Access the header row
        $headerRow = $collection->first();

//        var_dump($headerRow); die;

        // Validate column names
        $this->validateColumnNames($headerRow);

        foreach ($collection as $index => $row) {
            $validator = Validator::make($row->toArray(), $this->rules(), $this->validationMessages());

            if ($validator->fails()) {
                $this->errors[] = [
                    'row' => $index + 2, // Excel rows are 1-indexed, but we want to show 1-based row numbers
                    'errors' => $validator->errors()->all(),
                ];
                continue;
            }

            $this->processRow($row->toArray());
            $this->importCount++;
        }
    }

    protected function rules()
    {
        return [
            'size' => 'required|in:s,m,l,xl',
            'weight' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string|max:255',
            'status' => 'required|max:2',
            'tracking_code' => 'required|min:10|max:10',
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:clients,id',
            'source_id' => 'required|exists:addresses,id',
            'destination_id' => 'required|exists:addresses,id',
            'tariff_id' => 'required|exists:tariffs,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ];
    }

    protected function validationMessages()
    {
        // Define custom validation messages if needed
        return [];
    }

    protected function processRow(array $row)
    {
        $sender = User::find($row['sender_id']);
        $receiver = Client::find($row['receiver_id']);
        $source = Address::find($row['source_id']);
        $destination = Address::find($row['destination_id']);
        $vehicle = Vehicle::find($row['vehicle_id']);
        $tariff = Tariff::find($row['tariff_id']);

        $parcel = new Parcel([
            'size' => $row['size'],
            'weight' => $row['weight'],
            'notes' => $row['notes'],
            'status' => $row['status'],
            'tracking_code' => $row['tracking_code'],
        ]);

        $parcel->sender()->associate($sender);
        $parcel->receiver()->associate($receiver);
        $parcel->source()->associate($source);
        $parcel->destination()->associate($destination);
        $parcel->vehicle()->associate($vehicle);
        $parcel->tariff()->associate($tariff);

        $parcel->save();
    }

    protected function validateColumnNames($headerRow)
    {
        if ($headerRow === null) {
            // Throw an exception for the scenario where $headerRow is null
            throw new Exception("No data columns found in the file. Please make sure the file contains data, not just heading rows.");
        }

        $requiredColumns = [
            'size', 'weight', 'notes', 'status', 'tracking_code',
            'sender_id', 'receiver_id', 'source_id', 'destination_id',
            'vehicle_id', 'tariff_id',
        ];

        $actualColumns = $headerRow->keys()->toArray();

        $missingColumns = array_diff($requiredColumns, $actualColumns);

        if (!empty($missingColumns)) {
            // Throw an exception with the missing columns
            if (count($missingColumns) == 1) {
                $errorMessage = "Column [{$missingColumns[0]}] is missing or incorrect.";
            } else {
                $errorMessage = "Columns [" . implode(', ', $missingColumns) . "] are missing or incorrect.";
            }
            throw new Exception($errorMessage);
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getImportCount()
    {
        return $this->importCount;
    }
}
