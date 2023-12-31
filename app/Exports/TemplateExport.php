<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplateExport implements FromCollection, WithHeadings
{
    /**
     * Retrieve the data for the export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect([
            ['s', '33', 'This parcel is fragile.', '1', '1234567890', '3', '4', '5', '6', '7', '1'],
        ]);
    }

    /**
     * Define the headings for the exported data.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'size',
            'weight',
            'notes',
            'status',
            'tracking_code',
            'sender_id',
            'receiver_id',
            'source_id',
            'destination_id',
            'vehicle_id',
            'tariff_id',
        ];
    }
}
