<?php

namespace App\Events;

use App\Resident;
use Illuminate\Queue\SerializesModels;

class ResidentCreated
{
    use SerializesModels;

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
}
