<?php

namespace App\Events;

use App\Punishment;
use Illuminate\Queue\SerializesModels;

class StoredPunishment
{
    use SerializesModels;

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
}
