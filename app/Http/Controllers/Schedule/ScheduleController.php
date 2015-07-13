<?php

namespace App\Http\Controllers\Schedule;

use Illuminate\Http\Request;

use Input;
use View;
use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use App\Http\Models\Project\Version;
use App\Http\Models\Project\Story;
use App\Http\Models\Project\DevPlan;


class ScheduleController extends SingleFormController
{

    public function __construct()
    {
        View::share('versions', Version::dict(0));
        return parent::__construct();
    }

    public function selectedVersion()
    {
        $version_id = $this->inputId("version_id");
        if ($version_id)
        {
            $version = Version::find($version_id);
            View::share("selected_version", $version_id);
        }
        else
        {
            $version = Version::orderBy('id', 'desc')->first();
            View::share("selected_version", $version->id);
        }
        return $version;
    }

    public function getIndex()
    {
        $project_dev_plans = [];
        $min_date = null;
        $max_date = null;
        foreach($this->selectedVersion()->storys as $story)
        {
            $dev_plans = $story->dev_plans()->orderBy('start_at')->get();
            $project_dev_plans[] = [
                "story" => $story, 
                "dev_plans" => $dev_plans,
                ];

            foreach($dev_plans as $dev_plan)
            {
                if(empty($min_date) || $min_date > $dev_plan->plan_start_at)
                {
                    $min_date = $dev_plan->plan_start_at;
                }

                if(empty($max_date) || $max_date < $dev_plan->plan_complete_at)
                {
                    $max_date = $dev_plan->plan_complete_at;
                }
            }
        }

        return $this->viewMake('schedule', [
            'project_dev_plans' =>$project_dev_plans,
            'calendar'=>$this->genCalendar($min_date, $max_date),
            ]);
    }

    public function genCalendar($min_date, $max_date)
    {
        $calendar = (object)null;
        #$calendar->min_date = strtotime(explode($min_date, ' ')[0]." 00：00:00");
        $calendar->min_date = strtotime(explode(' ', $min_date)[0]." 00:00:00");
        $calendar->max_date = strtotime(date_after(explode(' ',date_add( $max_date)[0]." 00:00:00")));

        return $calendar;
    }


}
