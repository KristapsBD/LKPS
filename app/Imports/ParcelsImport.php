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

    /**
     * Process the imported Excel collection.
     *
     * @param \Illuminate\Support\Collection $collection
     * @return void
     */
    public function collection(Collection $collection)
    {
        // Access the header row
        $headerRow = $collection->first();

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

    /**
     * Define validation rules for each column.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            // Define validation rules for each column
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

    /**
     * Define validation error messages.
     *
     * @return array
     */
    protected function validationMessages()
    {
        return [];
    }

    /**
     * Process each row of the imported data.
     *
     * @param array $row
     * @return void
     */
    protected function processRow(array $row)
    {
        // Retrieve related models based on IDs from the imported row
        $sender = User::find($row['sender_id']);
        $receiver = Client::find($row['receiver_id']);
        $source = Address::find($row['source_id']);
        $destination = Address::find($row['destination_id']);
        $vehicle = Vehicle::find($row['vehicle_id']);
        $tariff = Tariff::find($row['tariff_id']);

        // Create a new Parcel model with data from the imported row
        $parcel = new Parcel([
            'size' => $row['size'],
            'weight' => $row['weight'],
            'notes' => $row['notes'],
            'status' => $row['status'],
            'tracking_code' => $row['tracking_code'],
        ]);

        // Associate related models with the Parcel
        $parcel->sender()->associate($sender);
        $parcel->receiver()->associate($receiver);
        $parcel->source()->associate($source);
        $parcel->destination()->associate($destination);
        $parcel->vehicle()->associate($vehicle);
        $parcel->tariff()->associate($tariff);

        $parcel->save();
    }

    /**
     * Validate the correctness of column names in the header row.
     *
     * @param \Illuminate\Support\Collection|null $headerRow
     * @throws \Exception
     * @return void
     */
    protected function validateColumnNames($headerRow)
    {
        if ($headerRow === null) {
            // Throw an exception for the scenario where $headerRow is null
            throw new Exception("No data columns found in the file. Please make sure the file contains data, not just heading rows.");
        }

        // Define the required and actual column names
        $requiredColumns = [
            'size', 'weight', 'notes', 'status', 'tracking_code',
            'sender_id', 'receiver_id', 'source_id', 'destination_id',
            'vehicle_id', 'tariff_id',
        ];

        $actualColumns = $headerRow->keys()->toArray();

        // Check for missing columns and throw an exception if any are found
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

    /**
     * Get validation errors encountered during the import.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Get the count of successfully imported rows.
     *
     * @return int
     */
    public function getImportCount()
    {
        return $this->importCount;
    }
}
