<?php

namespace App\Events;

use App\Fine;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserFined
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Fine
     */
    public $fine;

    /**
     * Create a new event instance.
     *
     * @param Fine $fine
     */
    public function __construct(Fine $fine)
    {
        $this->fine = $fine;
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
