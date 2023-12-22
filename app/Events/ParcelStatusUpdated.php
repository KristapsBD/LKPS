<?php

namespace App\Events;

use App\Models\Parcel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParcelStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $parcel;
    public $oldStatus;

    /**
     * Create a new event instance.
     */
    public function __construct(Parcel $parcel, $oldStatus)
    {
        $this->parcel = $parcel;
        $this->oldStatus = $oldStatus;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
