<?php

namespace App\Events;

use App\Fine;
use Illuminate\Queue\SerializesModels;

class UserFined
{
    use SerializesModels;

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
}
