<?php

namespace App\Events;

use App\DoctorAppointment;
use Illuminate\Queue\SerializesModels;

class NewDoctorAppointment
{
    use SerializesModels;

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
}
