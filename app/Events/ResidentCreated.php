<?php

namespace App\Events;

use App\Resident;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResidentCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Resident
     */
    public $resident;

    /**
     * Create a new event instance.
     *
     * @param Resident $resident
     */
    public function __construct(Resident $resident)
    {
        $this->resident = $resident;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
