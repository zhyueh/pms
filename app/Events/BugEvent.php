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
    public $comment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($bugId,$action = 'update', $comment='')
    {
        $this->bugId = $bugId;
        $this->action = $action;
        $this->comment=$comment;
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
