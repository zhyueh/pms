<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BugEvent extends Event
{
    use SerializesModels;
    public $bugId;
    public $action;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($bugId,$action = 'update')
    {
        $this->bugId = $bugId;
        $this->action = $action;
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
