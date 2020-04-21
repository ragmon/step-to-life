<?php

namespace App\Events;

use App\Note;
use Illuminate\Queue\SerializesModels;

class NewNote
{
    use SerializesModels;

    /**
     * @var Note
     */
    public $note;

    /**
     * Create a new event instance.
     *
     * @param Note $note
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }
}
