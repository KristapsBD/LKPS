<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplateExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            ['s', '33', 'This parcel is fragile.', '1', '2', '3', '4', '5', '6', '7', '1'],
        ]);
    }

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
