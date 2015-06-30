<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;

use Input;
use Redirect;
use View;


use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use App\User;
use App\Http\Models\Project\Story;
use App\Http\Models\Project\Team;
use App\Http\Models\Project\DevPlan;
use App\Http\Models\Setting\Enum;
use App\Http\Models\Operation;

class DevPlanController extends ProjectBaseController
{

    public function __construct()
    {
        $this->model = 'App\Http\Models\Project\DevPlan';
        $this->fields_show = ['id', 'story_name', 'owner_name', 'priority' ,'status_name'];

        $this->fields_edit = ['dev_plan_name','story_name', 'team_name','owner_name', 'priority_name', 'work_hour', 'plan_start_at', 'plan_complete_at' ,  'dev_plan_type_name' ,'status_name', 'description'];

        parent::__construct();
    }

    public function getIndex()
    {
        $this->formIndex = 'project.devplan_list';

        $this->add_enum_dict('story_name', 'story_id', (new Story)->dict());

        $this->add_enum_dict('owner_name', 'owner_id', User::dict());
        $this->add_enum('status_name', 'status', "dev_plan.status");


        //add operation
        $start_btn = new Operation(gen_action('getStartPlan'), 'start');
        $start_btn->style_icon = 'play';
        $this->operations['start'] = $start_btn;

        $refresh_btn = new Operation(gen_action('getRefreshPlan'), 'refresh');
        $refresh_btn->style_icon = 'refresh';
        $this->operations['refresh'] = $refresh_btn;

        $complete_btn = new Operation(gen_action('getCompletePlan'), 'complete');
        $complete_btn->style_icon = 'off';
        $this->operations['complete'] = $complete_btn;


        $this->operations['edit'] = new Operation(gen_action('getEdit'), 'edit');

        if ($this->version)
        {
            $storyids = [];
            foreach ($this->version->storys as $story)
            {
                $storyids[] = $story->id;
            }

            $this->index_filters["story_id"] = [
                "type"=>"in", 
                "value"=>$storyids,
            ];
        }

        return parent::getIndex();
    }

    public function getViewDevPlan()
    {
        $id = intval(Input::get("id"));

        $plan = DevPlan::find($id);
        $story = Story::with('comments')->find($plan->story_id);
        $project = $story->project;

        $this->add_enum_dict('status_name', 'status', Enum::dict('dev_plan.status'));
        $this->add_enum_dict('priority_name', 'priority', Enum::dict('dev_plan.priority'));
        $this->add_enum_dict('updated', 'updated_by', User::dict());
        $this->add_raw_enum_dict('team_name', 'team_id', $project->teams, "id", "team_name");

        return $this->viewMake('project.view_devplan',
            [
                'model'=> $plan,
                'story'=> $story,
                'story_comments'=>$story->comments,
                ]
        );


    }

    public function getCompletePlan()
    {
        $id = intval(Input::get("id"));
        $plan = DevPlan::find($id);
        $plan->complete_at = date('Y-m-d H:i:s');
        $plan->save();

        return Redirect::to(action($this->controller."@getIndex"));

    }

    public function getRefreshPlan()
    {
        $id = intval(Input::get("id"));
        $plan = DevPlan::find($id);
        $plan->start_at = Null;
        $plan->complete_at = Null;
        $plan->save();

        return Redirect::to(action($this->controller."@getIndex"));

    }

    public function getStartPlan()
    {
        $id = intval(Input::get("id"));
        $plan = DevPlan::find($id);
        $plan->start_at = date('Y-m-d H:i:s');
        $plan->save();

        return Redirect::to(action($this->controller."@getIndex"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function postCreate()
    {
        $story_id = intval(Input::get("story_id"));
        $story = Story::find($story_id);

        $team_id = intval(Input::get("team_id"));
        $team = Team::find($team_id);

        $this->add_raw_enum_dict('story_name', 'story_id', [$story], "id", "story_name");
        $this->add_raw_enum_dict('owner_name', 'owner_id', $team->member()->get(), "id", "name");
        $this->add_raw_enum_dict('team_name', 'team_id', [$team], "id", "team_name");
        $this->add_enum('status_name', 'status', "dev_plan.status");
        $this->add_enum('dev_plan_type_name', 'dev_plan_type', "dev_plan.type");
        $this->add_enum('priority_name', 'priority', "dev_plan.priority");
        $this->add_enum('work_hour', 'work_hour', "work_hour");
        //View::share("fields_enum", $this->fields_enum);

        $model = new $this->model;
        $model->dev_plan_name = "story#".$story->id."::".$team->team_name;
        $model->plan_start_at = date('Y-m-d H:00:00');
        $model->plan_complete_at = date('Y-m-d H:00:00');

        return $this->viewMake('project.edit_dev_plan', ['model'=> $model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postStore()
    {
        //
        return parent::postStore();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow()
    {
        //
        return parent::getShow();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit()
    {
        //
        $id = intval(Input::get("id"));
        $dev_plan = DevPlan::with('story', 'team')->find($id);

        $story = $dev_plan->story;

        $team = $dev_plan->team;

        $this->add_raw_enum_dict('story_name', 'story_id', [$story], "id", "story_name");
        $this->add_raw_enum_dict('owner_name', 'owner_id', $team->member()->get(), "id", "name");
        $this->add_raw_enum_dict('team_name', 'team_id', [$team], "id", "team_name");
        $this->add_enum('status_name', 'status', "dev_plan.status");
        $this->add_enum('dev_plan_type_name', 'dev_plan_type', "dev_plan.type");
        $this->add_enum('priority_name', 'priority', "dev_plan.priority");
        $this->add_enum('work_hour', 'work_hour', "work_hour");
        //View::share("fields_enum", $this->fields_enum);

        return $this->viewMake('project.edit_dev_plan', ['model'=> $dev_plan]);
    }

    public function postRemark()
    {
        $id = intval(Input::get("id"));
        $plan = DevPlan::find($id);
        $plan->remark = Input::get("remark");
        $plan->save();

        return Redirect::to(action_url("getIndex"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postUpdate()
    {
        //
        return parent::postUpdate();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postDestroy()
    {
        //
        return parent::postDestroy();
    }
}
