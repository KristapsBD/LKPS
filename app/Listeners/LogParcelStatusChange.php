<?php

namespace App\Listeners;

use App\Events\ParcelStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ParcelTracking;

class LogParcelStatusChange
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ParcelStatusUpdated $event): void
    {
        $parcel = $event->parcel;

        $parcelTracking = ParcelTracking::create([
            'old_status' => $event->oldStatus,
            'new_status' => $parcel->status,
        ]);

        $parcelTracking->parcel()->associate($parcel);

        $parcelTracking->save();
    }
}
