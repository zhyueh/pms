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
use Input;
use Redirect;
use App\Http\Models\Operation;
use Event;
use App\Events\BugEvent;


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
        $this->filter_list = 
            [
                'to_me'=>[
                    "owner_id"=>[
                        "type"=>'eq', 'value'=>Auth::user()->id
                    ]
                ],
                'wait'=> [
                    'close_time'=>['type'=>'null'],
                    'confirm_time'=>['type'=>'null']
                ],
                'doing'=>[
                    'close_time'=>['type'=>'null'],
                    'fix_time'=>['type'=>'null'],
                    'confirm_time'=>['type'=>'notnull']
                ],
                'waiting_close'=>[
                    'fix_time'=>['type'=>'notnull'],
                    'close_time'=>['type'=>'null'],
                    ],
                'close'=>[
                    'close_time'=>['type'=>'notnull'],
                    ],
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
        $re = parent::postStore();

        Event::fire(new BugEvent($this->inputId("id")));

        return $re;
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

        $op_comment = new Operation(gen_action('getBugOp'), 'write');
        $op_comment->style_icon ="pencil";
        $this->operations[] = $op_comment;

        //add confirm
        if (!$bug->confirm_time)
        {
            $op_confirm = new Operation(gen_action('getBugOp'), 'confirm');
            $op_confirm->style_icon="ok";
            $this->operations[] = $op_confirm;
        }

        //add reactive
        if ($bug->confirm_time && !$bug->fix_time)
        {
            $op_fix = new Operation(gen_action('getBugOp'), 'fix');
            $op_fix->style_icon="off";
            $this->operations[] = $op_fix;
        }

        //add reactive
        $op_reactive = new Operation(gen_action('getBugOp'), 'reactive');
        $op_reactive->style_icon="repeat";
        $this->operations[] = $op_reactive;

        $op_close = new Operation(gen_action('getBugOp'), 'close');
        $op_close->style_icon="check";
        $this->operations[] = $op_close;

        return $this->viewMake("project.view_bug",
            [
                'model'=>$bug,
            ]);
    }

    public function getBugOp()
    {
        $comment = Input::get("comment");
        $bug_id = $this->inputId("id");
        $bug = Bug::find($bug_id);
        $now = date('Y-m-d H:i:s');
        $op = "";
        if (input_contain_empty("confirm") && !$bug->confirm_time)
        {
            $op = "confirm";
            $bug->active_times = $bug->active_times + 1;
            $bug->confirm_time = $now;
        }else if(input_contain_empty("reactive"))
        {
            $op = "reactive";
            $bug->confirm_time = null;
            $bug->fix_time = null;
            $bug->close_time = null;
        }else if(input_contain_empty("fix"))
        {
            $op = "fix";
            $bug->fix_time = $now;
        }else if(input_contain_empty('close'))
        {
            $op = "close";
            $bug->close_time = $now;
        }else{
            $op = "write";
        }

        $bug->save();

        Event::fire(new BugEvent($bug_id, $op, $comment));

        //return Redirect::to(action_url("getIndex"));
        return Redirect::to(action_url("getShow", ['id'=>$bug->id]));
    }
}
