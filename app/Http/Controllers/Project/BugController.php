<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\SingleFormController;
use App\Http\Models\Project\Team;
use App\Http\Models\Project\TestCase;
use App\Http\Models\Project\Bug;
use App\Http\Models\Project\Version;

use App\User;
use Auth;
use Redirect;
use App\Http\Models\Operation;


class BugController extends ProjectBaseController
{
    public function __construct()
    {
        $this->model = 'App\Http\Models\Project\Bug';
        $this->fields_show = ['id' ,'bug_name', 'team_name', "owner",  'status'];
        $this->fields_edit = [ "test_case_name", "bug_name", "team_name", "owner", "description", "requirement", "status", "serverity", "priority"];

        $this->add_enum("status", "status", "bug.status");
        $this->add_enum("serverity");
        $this->add_enum("priority");
        $this->add_enum_dict("team_name", "team_id", (new Team)->dict());
        $this->add_enum_dict("test_case_name", "test_case_id", (new TestCase)->dict());
        $this->add_enum_dict("owner", "owner_id", User::dict());

        $this->add_enum_dict("version_name", "version_id", Version::dict(0));
        $this->formCreate = "project.edit_bug";
        parent::__construct();
    }


    public function getIndex()
    {
        $this->filter_list = [
            'to_me'=>["owner_id"=>["type"=>'eq', 'value'=>Auth::user()->id]],
            ];

        $op_edit = new Operation(gen_action("getEdit"), "edit");
        $op_show = new Operation(gen_action("getShow"), "show");
        $op_show->style_icon = "zoom-in";

        $this->operations = [ 
            $op_show,
            $op_edit,
            new Operation(gen_action("getDestroy"), "destroy"),
        ];

        if ($this->version)
        {
            $this->add_enum_dict("version_name", "version_id", Version::dict($this->version->project_id));
            /*
            $test_cases = [];
            foreach ($this->version->test_cases as $test_case)
            {
                $test_cases[] = $test_case->id;
            }

            $this->index_filters["test_case_id"] = [
                "type"=>"in", 
                "value"=>$test_cases,
            ];*/

            $this->index_filters["version_id"] = [
                "type"=>"eq", 
                "value"=>$this->version->id,
            ];
        }

        return parent::getIndex();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return parent::getCreate();
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
        $bug_id = $this->inputId("id");
        $bug = Bug::find($bug_id);


        $this->operations = [];

        //add confirm
        if (!$bug->confirm_time)
        {
            $op_confirm = new Operation(gen_action('getConfirmBug'), 'confirm');
            $op_confirm->style_icon="ok";
            $this->operations[] = $op_confirm;
        }

        //add reactive
        if ($bug->confirm_time && !$bug->fix_time)
        {
            $op_fix = new Operation(gen_action('getFixBug'), 'fix');
            $op_fix->style_icon="off";
            $this->operations[] = $op_fix;
        }

        //add reactive
        $op_reactive = new Operation(gen_action('getReactiveBug'), 'reactive');
        $op_reactive->style_icon="repeat";
        $this->operations[] = $op_reactive;


        return $this->viewMake("project.view_bug",
            [
                'model'=>$bug,
            ]);
    }

    public function getConfirmBug()
    {
        $bug_id = $this->inputId("id");
        $bug = Bug::find($bug_id);
        if (! $bug->confirm_time)
        {
            $bug->active_times = $bug->active_times + 1;
            $bug->confirm_time = date('Y-m-d H:i:s');
            $bug->save();
        }

        return Redirect::to(action_url("getShow", ['id'=>$bug->id]));
    }

    public function getReactiveBug()
    {
        $bug_id = $this->inputId("id");
        $bug = Bug::find($bug_id);
        $bug->confirm_time = null;
        $bug->close_time = null;
        $bug->fix_time = null;
        $bug->save();

        return Redirect::to(action_url("getShow", ['id'=>$bug->id]));

    }

    public function getFixBug()
    {
        $bug_id = $this->inputId("id");
        $bug = Bug::find($bug_id);
        $bug->fix_time = date('Y-m-d H:i:s');
        $bug->save();

        return Redirect::to(action_url("getShow", ['id'=>$bug->id]));
    }

    public function getCloseBug()
    {
        $bug_id = $this->inputId("id");
        $bug = Bug::find($bug_id);
        $bug->close_time = date('Y-m-d H:i:s');
        $bug->save();

        return Redirect::to(action_url("getShow", ['id'=>$bug->id]));
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
        return parent::getEdit();
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
