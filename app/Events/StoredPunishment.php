<?php

namespace App\Events;

use App\Punishment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoredPunishment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Punishment
     */
    public $punishment;

    /**
     * Create a new event instance.
     *
     * @param Punishment $punishment
     */
    public function __construct(Punishment $punishment)
    {
        $this->punishment = $punishment;
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
