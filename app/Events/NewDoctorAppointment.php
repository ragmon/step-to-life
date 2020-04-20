<?php

namespace App\Events;

use App\DoctorAppointment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewDoctorAppointment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var DoctorAppointment
     */
    public $doctorAppointment;

    /**
     * Create a new event instance.
     *
     * @param DoctorAppointment $doctorAppointment
     */
    public function __construct(DoctorAppointment $doctorAppointment)
    {
        $this->doctorAppointment = $doctorAppointment;
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
