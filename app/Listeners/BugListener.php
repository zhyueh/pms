<?php

namespace App\Listeners;

use App\Events\BugEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Models\Project\Bug;
use Auth;
use App\User;

class BugListener extends BaseListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BugEvent  $event
     * @return void
     */
    public function handle(BugEvent $event)
    {
        //-.-!
        if ($event->bugId > 1)
        {
            $bug = Bug::find($event->bugId);
        }
        else
        {
            $bug = Bug::orderBy('id', 'desc')->first();
        }
        $cc = [];
        if ($event->action == "fix")
        {
            $to = User::find($bug->created_by);
            $cc[] = User::find($bug->owner_id);
        }
        else
        {
            $to = User::find($bug->owner_id);
            $cc[] = User::find($bug->created_by);
        }
        $this->sendMail(
            'project.bug_email',
            $to,
            [
                'subject' => "BUG::".trans('title.'.$event->action)."=>".$bug->bug_name,
                'user'=>$to,
                'cc'=>$cc,
                'bug'=>$bug,
                'link'=> action_url('Project\BugController@getShow', ['id'=>$bug->id]),
            ]);
        //
    }
}
