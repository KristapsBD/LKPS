<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParcelsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $parcels;

    public function __construct($parcels)
    {
        $this->parcels = $parcels;
    }

    public function collection()
    {
        return collect($this->parcels);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Size',
            'Weight',
            'Notes',
            'Status',
            'Tracking Code',
            'Sender',
            'Sender Phone',
            'Receiver',
            'Receiver Phone',
            'Source Street',
            'Source City',
            'Source Postal Code',
            'Destination Street',
            'Destination City',
            'Destination Postal Code',
            'Vehicle Registration Number',
            'Tariff',
            'Created At',
        ];
    }

    public function map($parcel): array
    {
        return [
            $parcel->id,
            $parcel->size,
            $parcel->weight,
            $parcel->notes,
            mapParcelStatusToValue($parcel->status),
            $parcel->tracking_code,
            $parcel->sender->name,
            $parcel->sender->phone,
            $parcel->receiver->name,
            $parcel->receiver->phone,
            $parcel->source->street,
            $parcel->source->city,
            $parcel->source->postal_code,
            $parcel->destination->street,
            $parcel->destination->city,
            $parcel->destination->postal_code,
            $parcel->vehicle->registration_number ?? 'Not Assigned',
            $parcel->tariff->name ?? 'Not Assigned',
            $parcel->created_at,
        ];
    }
}
