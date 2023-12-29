<?php

namespace App\Listeners;

use App\Events\ParcelCreationEvent;
use App\Mail\ReceiverParcelCreationEmail;
use App\Mail\SenderParcelCreationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendParcelCreationEmail implements ShouldQueue
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
    public function handle(ParcelCreationEvent $event): void
    {
        $parcel = $event->parcel;
        $sender = $parcel->sender;
        $receiver = $parcel->receiver;

        Mail::to($sender->email)->send(new SenderParcelCreationEmail($parcel));
        Mail::to($receiver->email)->send(new ReceiverParcelCreationEmail($parcel));
    }
}
