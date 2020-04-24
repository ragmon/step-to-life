<?php

namespace App\Events;

use App\ResidentParent;
use Illuminate\Queue\SerializesModels;

class ParentCreated
{
    use SerializesModels;

    /**
     * @var ResidentParent
     */
    public $parent;

    /**
     * Create a new event instance.
     *
     * @param ResidentParent $parent
     */
    public function __construct(ResidentParent $parent)
    {
        $this->parent = $parent;
    }
}
