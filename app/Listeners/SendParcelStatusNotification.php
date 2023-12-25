<?php

namespace App\Listeners;

use App\Events\ParcelStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendParcelStatusNotification implements ShouldQueue
{
    use InteractsWithQueue;

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
        $senderEmail = $parcel->sender->email;

//        TODO UNCOMMENT FOR PROUCTION
        Mail::to($senderEmail)->send(new \App\Mail\ParcelStatusUpdated($parcel));
    }
}
